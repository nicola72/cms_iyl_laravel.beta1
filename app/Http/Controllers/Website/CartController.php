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
        $nome          = $request->post('nome');
        $cognome       = $request->post('cognome');
        $email         = $request->post('email');
        $indirizzo     = $request->post('indirizzo');
        $citta         = $request->post('citta');
        $prov          = $request->post('prov',null);
        $cap           = $request->post('cap');
        $tel           = $request->post('tel');
        $data_nascita  = $request->post('data_nascita');
        $citta_nascita = $request->post('citta_nascita');
        $id_nazione    = $request->post('nazione');
        $pagamento     = $request->post('pagamento');

        //ALTRI DATI
        $peso_carrello   = \Session::get('preso_carrello');
        $nazione         = Country::find($id_nazione);
        $esenzione_iva   = EsenzioneIva::get($nazione);
        $spese_pagamento = ($pagamento == 'contrassegno') ? 9 : 0;
        $spese_conf_reg  = array_key_exists('conf_regalo', $request->all()) ? 5 : 0;

        //DATI CARRELLO (IMPORTO E QTA')
        $carts = $this->getCarts();
        $importo = 0;
        $tot_qta = 0;
        foreach($carts as $cart)
        {
            $importo+= ($cart->product->prezzo_vendita() * $cart->qta);
            $tot_qta+= $cart->qta;
        }

        // SPESE SPEDIZIONE
        $spese_spedizione = SpeseSpedizione::get($nazione, $peso_carrello, $importo);

        //IMPONIBILE CARRELLO
        $imponibile = round(($importo / 1.22), 2);

        //IVA CARRELLO
        $iva = $importo - $imponibile;

        //SE ESENTE IVA LA TOLGO DALL'IMPORTO DEL CARRELLO
        $sconto_iva = 0;
        if($esenzione_iva == "1")
        {
            $sconto_iva = $iva;
            $importo = $importo - $iva;
        }

        //SCONTO COUPON
        $sconto_coupon = $this->getSontoCoupon($importo);


        //creo l'array DATI ORDINE
        $ordine = [];

        $ordine['nome']          = $request->post('nome');
        $ordine['cognome']       = $request->post('cognome');
        $ordine['email']         = $request->post('email');
        $ordine['indirizzo']     = $request->post('indirizzo');
        $ordine['citta']         = $request->post('citta');
        $ordine['prov']          = $request->post('prov',null);
        $ordine['cap']           = $request->post('cap');
        $ordine['tel']           = $request->post('tel');
        $ordine['data_nascita']  = $request->post('data_nascita');
        $ordine['citta_nascita'] = $request->post('citta_nascita');


        $country_id = $request->post('nazione');
        $ordine['nazione'] = $country_id;

        $country = Country::find($country_id);

        $pagamento = $request->post('pagamento');
        $ordine['pagamento'] = $pagamento;

        $peso_carrello = \Session::get('preso_carrello');

        $esenzione_iva = EsenzioneIva::get($country);
        $ordine['esenzione_iva'] = $esenzione_iva;

        $spese_pagamento = ($pagamento == 'contrassegno') ? 9 : 0;
        $ordine['spese_pagamento'] = $spese_pagamento;

        $confezione_regalo = array_key_exists('regalo', $request->all()) ? 1 : 0;
        $ordine['confezione_regalo'] = $confezione_regalo;

        $carts = $this->getCarts();

        $importo_carrello = 0;
        $importo_prodotti = 0;
        $tot_qta = 0;
        foreach($carts as $cart)
        {
            $importo_carrello+= ($cart->product->prezzo_vendita() * $cart->qta);
            $importo_prodotti+= ($cart->product->prezzo_vendita() * $cart->qta);
            $tot_qta+= $cart->qta;
        }

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

        // SPESE SPEDIZIONE
        $spese_spedizione = SpeseSpedizione::get($country, $peso_carrello,$importo_carrello);
        $ordine['spese_spedizione'] = $spese_spedizione;

        // IMPONIBILE E IMPONIBILE PIù IVA
        $imponibile_carrello = round(($importo_carrello / 1.22), 2);
        $ordine['imponibile'] = $imponibile_carrello;
        $ordine['imponibile_piu_iva'] = $importo_carrello;

        // IVA DEL CARRELLO
        $iva_carrello = $importo_carrello - $imponibile_carrello;
        $ordine['iva_carrello'] = $iva_carrello;

        //SPESA PER CONF.REGALO
        $spesa_conf_regalo = 0;
        if($confezione_regalo)
        {
            $spesa_conf_regalo = 5;
        }
        $ordine['spesa_conf_regalo'] = $spesa_conf_regalo;

        //SE ESENTE IVA LA TOLGO DALL'IMPORTO DEL CARRELLO
        $tax_refund = 0;
        if($esenzione_iva == "1")
        {
            $tax_refund = $iva_carrello;
        }
        $importo_carrello = $importo_carrello - $tax_refund;
        $ordine['tax_refund'] = $tax_refund;

        $ordine['importo_carrello'] = $importo_carrello;

        //COUPON
        $sconto_coupon = 0;
        if(Session::get('coupon'))
        {
            $coupon = Session::get('coupon');
            if($coupon['tipo_sconto'] == 'fisso')
            {
                $sconto_coupon = $coupon['ammontare_sconto'];
            }
            else
            {
                $sconto_coupon = ($importo_carrello * $coupon['ammontare_sconto']) / 100;
            }
        }
        $ordine['sconto_coupon'] = $sconto_coupon;

        $totale_carrello = $importo_carrello - $sconto_coupon + $spese_spedizione + $spese_pagamento + $spesa_conf_regalo;
        $totale_carrello = ($totale_carrello < 0) ? 0 : $totale_carrello;

        //inserisco tutti i dati nella sessione
        \Session::put('ordine',$ordine);

        $macrocategorie = Macrocategory::where('stato',1)->orderBy('order')->get();

        $params = [
            'carts' => $carts,
            'user' => $user,
            'country' => $country,
            'macrocategorie' => $macrocategorie,
            'user_details' => $user_details,
            'importo_carrello' => $importo_carrello,
            'importo_prodotti' => $importo_prodotti,
            'spese_spedizione' => $spese_spedizione,
            'sconto_coupon' => $sconto_coupon,
            'pagamento' => $pagamento,
            'spese_conf_regalo' => $spesa_conf_regalo,
            'spese_pagamento' => $spese_pagamento,
            'esente_iva' => $esenzione_iva,
            'tax_refund' => $tax_refund,
            'imponibile' => $imponibile_carrello,
            'totale_carrello' => $totale_carrello,
            'iva_carrello' => $iva_carrello,
            'tot_qta' => $tot_qta
        ];

        return view('website.cart.riepilogo_ordine',$params);
    }

    public function submit()
    {
        $carts = $this->getCarts();

        $sconto_coupon = Session::get('ordine')['sconto_coupon'];
        $spesa_conf_regalo = Session::get('ordine')['spesa_conf_regalo'];

        $importo_carrello = 0;
        $importo_prodotti = 0;
        $tot_qta = 0;
        foreach($carts as $cart)
        {
            $importo_carrello+= ($cart->product->prezzo_vendita() * $cart->qta);
            $importo_prodotti+= ($cart->product->prezzo_vendita() * $cart->qta);
            $tot_qta+= $cart->qta;
        }

        $imponibile_carrello = round(($importo_carrello / 1.22), 2);
        $iva_carrello = $importo_carrello - $imponibile_carrello;

        if(Session::get('ordine')['esenzione_iva'] == 1)
        {
            $importo_carrello = $importo_carrello - $iva_carrello;
            $iva_carrello = 0;
        }

        $config = \Config::get('website_config');

        //inserisco ORDINE NEL DATABASE
        try{

            $order = new Order();
            if(\Auth::check())
            {
                $order->user_id = \Auth::user()->id;

            }
            $order->spese_spedizione = Session::get('ordine')['spese_spedizione'];
            $order->spese_conf_regalo = Session::get('ordine')['spesa_conf_regalo'];
            $order->spese_contrassegno = Session::get('ordine')['spese_pagamento'];
            $order->sconto = Session::get('ordine')['ammontare_sconto'];

            $order->sconto = $sconto_importo;
            $order->imponibile = $importo_totale;
            $order->iva = $iva;
            $order->importo = $importo_totale + $iva;

            $order->save();

            foreach($carts as $cart)
            {
                $orderDetail = new ItalOrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $cart->product_id;
                $orderDetail->codice = $cart->product->codice;
                $orderDetail->nome_prodotto = $cart->product->{'nome_'.\App::getLocale()};
                $orderDetail->qta = $cart->qta;
                $orderDetail->prezzo = $cart->product->prezzo_netto(\Auth::user());
                $orderDetail->totale = $cart->product->prezzo_netto(\Auth::user()) * $cart->qta;
                $orderDetail->save();
            }
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
            if($coupon['tipo_sconto'] == 'fisso')
            {
                $sconto_coupon = $coupon['ammontare_sconto'];
            }
            else
            {
                $sconto_coupon = ($importo * $coupon['ammontare_sconto']) / 100;
            }
        }
        return $sconto_coupon;
    }


}
