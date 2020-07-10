<?php
namespace App\Http\Controllers\Website;

use App\Mail\Contact;
use App\Model\Cart;
use App\Model\Category;
use App\Model\Country;
use App\Model\Coupon;
use App\Model\Domain;
use App\Model\File;
use App\Model\Macrocategory;
use App\Model\Material;
use App\Model\Newsitem;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\OrderShipping;
use App\Model\Page;
use App\Model\Pairing;
use App\Model\Product;
use App\Model\Province;
use App\Model\Review;
use App\Model\Seo;
use App\Model\Slider;
use App\Model\Style;
use App\Model\Website\UserDetail;
use App\Service\EsenzioneIva;
use App\Service\SpeseSpedizione;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\Url;
use App\Http\Controllers\Controller;
use App\Service\GoogleRecaptcha;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        //prendo i prodotti del carrello con session_id se non loggato, con user_id se loggato
        $carts = $this->getCarts();

        //prendo i dati dell'utente se registrato
        if(\Auth::check())
        {
            $user = \Auth::getUser();
            $user_details = UserDetail::where('user_id', $user->id)->first();
        }
        else
        {
            $user = false;
            $user_details = false;
        }

        //calcolo IMPORTO CARRELLO
        $importo_carrello = 0;
        foreach($carts as $cart)
        {
            $importo_carrello+= ($cart->product->prezzo_vendita() * $cart->qta);
        }

        //calcolo PESO CARRELLO - se il peso supera i 1000kg non potrà procedere con l'ordine
        $peso_carrello = 0;
        foreach($carts as $cart)
        {
            $peso_carrello+= ($cart->product->peso * $cart->qta);
        }

        //inserisco nella sessione il peso del carrello
        Session::put('peso_carrello',$peso_carrello);

        //PROVINCE e NAZIONI per il form
        $province = Province::all()->sortBy('provincia');
        $countries = Country::all()->sortBy('nome_'.\App::getLocale());

        //le macro servono per il menu
        $macrocategorie = Macrocategory::where('stato',1)->orderBy('order')->get();

        $params = [
            'carts' => $carts,
            'form_name' => 'form_carrello',
            'user' => $user,
            'user_details' => $user_details,
            'macrocategorie' => $macrocategorie,
            'province' => $province,
            'countries' => $countries,
            'importo_carrello' => $importo_carrello,
            'peso_carrello' => $peso_carrello,
        ];

        return view('website.cart.index',$params);
    }

    public function resume(Request $request)
    {
        //inserisco i dati nella sessione
        $request->flash();

        //validazione tramite laravel -- l'errore compare in flash_messages ($errors->any())
        $request->validate([
            'nome'         => 'required',
            'cognome'      => 'required',
            'nazione'      => 'required',
            'email'        => 'required',
            'citta'        => 'required',
            'indirizzo'    => 'required',
            'tel'          => 'required',
            'cap'          => 'required',
            'data_nascita' => 'required',
            'citta_nascita'=> 'required',
            'pagamento'    => 'required'
        ]);

        //raccolgo i DATI FORM
        $nome           = $request->post('nome');
        $cognome        = $request->post('cognome');
        $email          = $request->post('email');
        $indirizzo      = $request->post('indirizzo');
        $citta          = $request->post('citta');
        $prov           = $request->post('prov',null);
        $cap            = $request->post('cap');
        $tel            = $request->post('tel');
        $data_nascita   = $request->post('data_nascita');
        $citta_nascita  = $request->post('citta_nascita');
        $id_nazione     = $request->post('nazione');
        $tipo_pagamento = $request->post('pagamento');

        //ALTRI DATI
        $peso_carrello   = \Session::get('preso_carrello');
        $nazione         = Country::find($id_nazione);
        $esente_iva      = EsenzioneIva::get($nazione);
        $spese_pagamento = ($tipo_pagamento == 'contrassegno') ? 9 : 0;
        $spese_conf_reg  = array_key_exists('conf_regalo', $request->all()) ? 5 : 0;

        //DATI CARRELLO (IMPORTO E QTA')
        $carts = $this->getCarts();
        $lordo = 0;
        $tot_qta = 0;
        foreach($carts as $cart)
        {
            $lordo+= ($cart->product->prezzo_vendita() * $cart->qta);
            $tot_qta+= $cart->qta;
        }

        // SPESE SPEDIZIONE
        $spese_spedizione = SpeseSpedizione::get($nazione, $peso_carrello, $lordo);

        //IMPONIBILE CARRELLO
        $imponibile = round(($lordo / 1.22), 2);

        //IVA CARRELLO
        $iva = $lordo - $imponibile;

        //SE ESENTE IVA LA TOLGO DALL'IMPORTO DEL CARRELLO
        if($esente_iva == "1")
        {
            $sconto_iva = $iva;
            $importo = $lordo - $iva;
        }
        else
        {
            $sconto_iva = 0;
            $importo = $lordo;
        }

        //SCONTO COUPON
        $sconto_coupon = $this->getSontoCoupon($importo);

        $totale = $importo - $sconto_coupon + $spese_spedizione + $spese_pagamento + $spese_conf_reg;
        $totale = ($totale < 0) ? 0 : $totale;

        //ARRAY ORDINE da inserire nella SESSIONE
        $ordine = [];
        $ordine['nome']             = $nome;
        $ordine['cognome']          = $cognome;
        $ordine['email']            = $email;
        $ordine['indirizzo']        = $indirizzo;
        $ordine['citta']            = $citta;
        $ordine['prov']             = $prov;
        $ordine['cap']              = $cap;
        $ordine['tel']              = $tel;
        $ordine['data_nascita']     = $data_nascita;
        $ordine['citta_nascita']    = $citta_nascita;
        $ordine['nazione']          = $nazione;
        $ordine['tipo_pagamento']   = $tipo_pagamento;
        $ordine['esente_iva']       = $esente_iva;
        $ordine['spese_pagamento']  = $spese_pagamento;
        $ordine['spese_conf_reg']   = $spese_conf_reg;
        $ordine['spese_spedizione'] = $spese_spedizione;
        $ordine['imponibile']       = $imponibile;
        $ordine['lordo']            = $lordo;
        $ordine['iva']              = $iva;
        $ordine['sconto_iva']       = $sconto_iva;
        $ordine['importo']          = $importo; //è uguale a $lordo o $lordo-$iva in base alla nazione
        $ordine['sconto_coupon']    = $sconto_coupon;
        $ordine['totale']           = $totale;

        //inserisco tutti i dati nella sessione
        \Session::put('ordine',$ordine);

        if(\Auth::check())
        {
            $user = \Auth::getUser();
            $user_details = UserDetail::where('user_id', $user->id)->first();
        }
        else
        {
            $user = false;
            $user_details = false;
        }

        $macrocategorie = Macrocategory::where('stato',1)->orderBy('order')->get();

        $params = [
            'carts'             => $carts,
            'user'              => $user,
            'nazione'           => $nazione,
            'macrocategorie'    => $macrocategorie,
            'user_details'      => $user_details,
            'importo'           => $importo,
            'lordo'             => $lordo,
            'spese_spedizione'  => $spese_spedizione,
            'sconto_coupon'     => $sconto_coupon,
            'tipo_pagamento'    => $tipo_pagamento,
            'spese_conf_regalo' => $spese_conf_reg,
            'spese_pagamento'   => $spese_pagamento,
            'esente_iva'        => $esente_iva,
            'sconto_iva'        => $sconto_iva,
            'imponibile'        => $imponibile,
            'totale'            => $totale,
            'iva'               => $iva,
            'tot_qta'           => $tot_qta
        ];

        return view('website.cart.riepilogo_ordine',$params);
    }

    public function submit()
    {
        $sconto_coupon     = Session::get('ordine')['sconto_coupon'];
        $spese_conf_reg    = Session::get('ordine')['spese_conf_reg'];
        $spese_spedizione  = Session::get('ordine')['spese_spedizione'];
        $spese_pagamento   = Session::get('ordine')['spese_pagamento'];
        $esente_iva        = Session::get('ordine')['esente_iva'];
        $tipo_pagamento    = Session::get('ordine')['tipo_pagamento'];
        $data_nascita      = Session::get('ordine')['data_nascita'];
        $luogo_nascita     = Session::get('ordine')['citta_nascita'];
        $nome              = Session::get('ordine')['nome'];
        $cognome           = Session::get('ordine')['cognome'];
        $email             = Session::get('ordine')['email'];
        $indirizzo         = Session::get('ordine')['indirizzo'];
        $citta             = Session::get('ordine')['citta'];
        $prov              = Session::get('ordine')['prov'];
        $tel               = Session::get('ordine')['tel'];
        $cap               = Session::get('ordine')['cap'];
        $nazione           = Session::get('ordine')['nazione'];

        //DATI CARRELLO (IMPORTO E QTA')
        $carts = $this->getCarts();
        $lordo = 0;
        $tot_qta = 0;
        foreach($carts as $cart)
        {
            $lordo+= ($cart->product->prezzo_vendita() * $cart->qta);
            $tot_qta+= $cart->qta;
        }

        //IMPONIBILE CARRELLO
        $imponibile = round(($lordo / 1.22), 2);

        //IVA CARRELLO
        $iva = $lordo - $imponibile;

        //SE ESENTE IVA LA TOLGO DALL'IMPORTO DEL CARRELLO
        if($esente_iva == "1")
        {
            $sconto_iva = $iva;
            $importo    = $lordo - $iva;
        }
        else
        {
            $sconto_iva = 0;
            $importo    = $lordo;
        }

        $totale = $importo - $sconto_coupon + $spese_spedizione + $spese_pagamento + $spese_conf_reg;
        $totale = ($totale < 0) ? 0 : $totale;

        $config = \Config::get('website_config');

        //inserisco ORDINE NEL DATABASE
        try{

            $order = new Order();
            if(\Auth::check())
            {
                $order->user_id = \Auth::user()->id;

            }
            $order->spese_spedizione   = $spese_spedizione;
            $order->spese_conf_regalo  = $spese_conf_reg;
            $order->spese_contrassegno = $spese_pagamento;
            $order->sconto             = $sconto_coupon;
            $order->modalita_pagamento = $tipo_pagamento;
            $order->imponibile         = $imponibile;
            $order->iva                = $iva;
            $order->sconto_iva         = $sconto_iva;
            $order->importo            = $importo;
            $order->data_nascita       = Carbon::createFromFormat('d-m-Y', $data_nascita)->format('Y-m-d');
            $order->luogo_nascita      = $luogo_nascita;
            $order->locale             = app()->getLocale();

            $order->save();

            //inserisco i vari prodotti in DETTAGLI ORDINE
            foreach($carts as $cart)
            {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $cart->product_id;
                $orderDetail->codice = $cart->product->codice;
                $orderDetail->nome_prodotto = $cart->product->{'nome_'.\App::getLocale()};
                $orderDetail->qta = $cart->qta;
                $orderDetail->prezzo = $cart->product->prezzo_vendita();
                $orderDetail->totale = $cart->product->prezzo_vendita() * $cart->qta;
                $orderDetail->save();
            }

            //inserisco l'INDIRIZZO DI SPEDIZIONE
            $orderShipping = new OrderShipping();
            $orderShipping->order_id = $order->id;
            $orderShipping->nome = $nome;
            $orderShipping->cognome = $cognome;
            $orderShipping->email = $email;
            $orderShipping->telefono = $tel;
            $orderShipping->indirizzo = $indirizzo;
            $orderShipping->cap = $cap;
            $orderShipping->citta = $citta;
            $orderShipping->provincia = $prov;
            $orderShipping->nazione = $nazione->nome_it;
            $orderShipping->save();
        }
        catch(\Exception $e){

            if($config['in_sviluppo'])
            {
                return back()->with('error',$e->getMessage());
            }
            return back()->with('error',trans('msg.errore_evasione_ordine'));
        }

        //Pagamento PAYPAL
        if(Session::get('ordine')['pagamento'] == 'paypal')
        {
            //1) Inserimento nella table tb_ordini

        }
        else
        {

        }
    }

    public function update(Request $request)
    {
        $cart_id = $request->query('id');
        $qta = $request->query('qta');

        $cart = Cart::find($cart_id);
        if(!$cart)
        {
            return ['result' => 0, 'msg'=> trans('msg.errore')];
        }

        try{
            $product = Product::find($cart->product_id);
            if($product->stock < $qta)
            {
                return ['result' => 0,'msg' => trans('msg.prodotto_non_piu_disponibile')];
            }
            $cart->qta = $qta;
            $cart->save();
        }
        catch(\Exception $e)
        {
            return ['result' => 0, 'msg'=> trans('msg.errore')];
        }
        return ['result' => 1,'msg' => trans('msg.quantita_aggiornata')];

    }

    public function destroy(Request $request)
    {
        $cart = Cart::find($request->id);
        $cart->delete();

        return back()->with('success',trans('msg.prodotto_eliminato_con_successo'));
    }

    public function addpairing(Request $request)
    {
        $id = $request->id;

        $pairing = Pairing::find($id);

        $product1 = $pairing->product1;
        $product2 = $pairing->product2;

        if(!is_object($product1) || !is_object($product2))
        {
            return ['result' => 0,'msg' => trans('msg.errore')];
        }

        $qta = 1; //la quantità è sempre 1

        $prodotti_da_inserire = [$product1,$product2];

        foreach($prodotti_da_inserire as $product)
        {
            //controllo che il prodotto non sia già nel carrello
            if(\Auth::user())
            {
                $cart = Cart::where('product_id',$product->id)->where('user_id',\Auth::user()->id)->first();
            }
            else
            {
                $cart = Cart::where('product_id',$product->id)->where('session_id',session()->getId())->first();
            }


            //se già nel carrello
            if($cart)
            {
                //se il prodotto non è disponibile
                if($product->stock < ($qta + $cart->qta))
                {
                    return ['result' => 0,'msg' => trans('msg.prodotto_non_piu_disponibile')];
                }

                try{
                    $cart->qta = $cart->qta + 1;
                    if(\Auth::user())
                    {
                        $cart->user_id = \Auth::user()->id;
                    }
                    $cart->save();
                }
                catch(\Exception $e){

                    return ['result' => 0,'msg' => $e->getMessage()];
                }

            }
            else
            {
                //se il prodotto non è disponibile
                if($product->stock < $qta)
                {
                    return ['result' => 0,'msg' => trans('msg.prodotto_non_piu_disponibile')];
                }

                try{

                    $cart = new Cart();
                    $cart->product_id = $product->id;
                    $cart->session_id = session()->getId();
                    $cart->qta = $qta;
                    if(\Auth::user())
                    {
                        $cart->user_id = \Auth::user()->id;
                    }
                    $cart->save();
                }
                catch(\Exception $e){

                    return ['result' => 0,'msg' => $e->getMessage()];
                }

            }
        }

        return ['result' => 1,'msg' => trans('msg.prodotto_aggiunto_al_carrello')];
    }

    public function addproduct(Request $request)
    {
        $id = $request->id;

        $product = Product::find($id);

        //se il prodotto non esiste esco
        if(!$product)
        {
            return ['result' => 0,'msg' => trans('msg.prodotto_non_trovato')];
        }

        $qta = 1; //la quantità è sempre 1

        //controllo che il prodotto non sia già nel carrello
        $cart = Cart::where('product_id',$product->id)->where('session_id',session()->getId())->first();

        //se già nel carrello
        if($cart)
        {
            //se il prodotto non è disponibile
            if($product->stock < ($qta + $cart->qta))
            {
                return ['result' => 0,'msg' => trans('msg.prodotto_non_piu_disponibile')];
            }

            try{

                $cart->qta = $cart->qta + 1;
                if(\Auth::user())
                {
                    $cart->user_id = \Auth::user()->id;
                }
                $cart->save();
            }
            catch(\Exception $e){

                return ['result' => 0,'msg' => $e->getMessage()];
            }

        }
        else
        {
            //se il prodotto non è disponibile
            if($product->stock < $qta)
            {
                return ['result' => 0,'msg' => trans('msg.prodotto_non_piu_disponibile')];
            }

            try{

                $cart = new Cart();
                $cart->product_id = $product->id;
                $cart->session_id = session()->getId();
                $cart->qta = $qta;
                if(\Auth::user())
                {
                    $cart->user_id = \Auth::user()->id;
                }
                $cart->save();
            }
            catch(\Exception $e){

                return ['result' => 0,'msg' => $e->getMessage()];
            }

        }

        return ['result' => 1,'msg' => trans('msg.prodotto_aggiunto_al_carrello')];
    }

    public function redeem_coupon(Request $request)
    {
        $codice = $request->coupon;
        $coupon = Coupon::where('codice',$codice)->first();

        if(!$coupon)
        {
            return ['result' => 0,'msg'=> trans('msg.coupon_non_trovato')];
        }

        //verifico se è scaduto
        if($coupon->valido_fino_a != '')
        {
            $oggi = Carbon::now('Europe/Rome');
            $fino_a = Carbon::parse($coupon->valido_fino_a);

            if($oggi->greaterThan($fino_a))
            {
                return ['result' => 0,'msg'=> trans('msg.coupon_scaduto')];
            }
        }

        //verifi se non è ancora attivo
        if($coupon->valido_da != '')
        {
            $oggi = Carbon::now('Europe/Rome');
            $da = Carbon::parse($coupon->valido_da);
            if($da->greaterThan($oggi))
            {
                return ['result' => 0,'msg'=> trans('msg.coupon_non_attivo')];
            }
        }

        //se è per singolo utente controllo che sia l'utente giusto
        if($coupon->user_id != 0)
        {
            //se loggato
            if(\Auth::user())
            {
                //user_id diverso da quello del coupon esco
                if(\Auth::user()->id != $coupon->user->id)
                {
                    return ['result' => 0,'msg'=> trans('msg.coupon_inesistente')];
                }
                //coupon già ustato
                elseif($coupon->utilizzato == 1)
                {
                    return ['result' => 0,'msg'=> trans('msg.coupon_gia_usato')];
                }
            }
            //non loggato quindi esco
            else
            {
                return ['result' => 0,'msg'=> trans('msg.coupon_inesistente')];
            }
        }

        //inserisco il coupon nella SESSIONE
        \Session::put('coupon',$coupon);

        return ['result' => 1, 'msg' => trans('msg.coupon_inserito')];
    }

    private function getCarts()
    {
        if(\Auth::check())
        {
            $user = \Auth::getUser();
            $carts = Cart::where('user_id',$user->id)->get();
        }
        else
        {
            $carts = Cart::where('session_id',session()->getId())->get();
        }
        return $carts;
    }

    private function getSontoCoupon($importo)
    {
        $sconto_coupon = 0;
        if(Session::get('coupon'))
        {
            $coupon = Session::get('coupon');
            if($coupon->tipo_sconto == 'fisso')
            {
                $sconto_coupon = $coupon->sconto;
            }
            else
            {
                $sconto_coupon = ($importo * $coupon->sconto) / 100;
            }
        }
        return $sconto_coupon;
    }


}
