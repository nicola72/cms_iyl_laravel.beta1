<?php

namespace App\Http\Controllers\Cms;

use App\Model\Category;
use App\Model\Cms\CmsClearpassword;
use App\Model\Cms\UserCms;
use App\Model\Domain;
use App\Model\File;
use App\Model\Module;
use App\Model\ModuleConfig;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\OrderShipping;
use App\Model\Pairing;
use App\Model\Product;
use App\Model\Review;
use App\Model\Url;
use App\Model\Website\Clearpassword;
use App\Model\Website\User;
use App\Model\Website\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SyncController extends Controller
{
    public function index()
    {
        $params = ['title_page' => 'Operazioni'];
        return view('cms.sync.index',$params);
    }

    public function sync_orders()
    {
        \DB::table('orders')->truncate();

        $vecchi = \DB::table('tb_ordini')->get();

        foreach($vecchi as $item)
        {
            $order = new Order();
            $order->id = $item->id;
            $order->user_id = $item->id_user;
            $order->created_at = $item->data;
            $order->spese_spedizione = $item->spese_spedizione;
            $order->spese_conf_regalo = $item->spese_conf_regalo;
            $order->spese_contrassegno = $item->spese_contrassegno;
            $order->modalita_pagamento = $item->modalita_pagamento;
            if($item->pagato == 'si')
            {
                $order->stato_pagamento = 1;
            }
            else
            {
                $order->stato_pagamento = 0;
            }

            $order->idtranspag = $item->idtranspag;
            $order->imponibile = $item->imponibile;
            $order->iva = $item->iva;
            $order->sconto_iva = $item->sconto_iva;
            $order->importo = $item->importo;
            $order->data_nascita = $item->data_nascita;
            $order->luogo_nascita = $item->luogo_nascita;
            $order->locale = $item->idl;

            $order->save();
        }
        return back()->with('success','Ordini sincronizzati!');
    }

    public function sync_order_details()
    {
        \DB::table('order_details')->truncate();

        $vecchi = \DB::table('tb_dettaglio_ordini')->get();

        foreach($vecchi as $item)
        {
            $detail = new OrderDetail();
            $detail->order_id = $item->id_ordine;
            $detail->product_id = $item->id_prodotto;
            $detail->codice = $item->codice;
            $detail->nome_prodotto = $item->prodotto;
            $detail->qta = $item->qta;
            $detail->prezzo = ($item->importo_tot / $item->qta);
            $detail->totale = $item->importo_tot;
            $detail->save();
        }
        return back()->with('success','Dettaglio ordini sincronizzati!');

    }

    public function sync_order_shippings()
    {
        \DB::table('order_shippings')->truncate();

        $vecchi = \DB::table('tb_spedizione_ordini')->get();

        foreach($vecchi as $item)
        {
            $shipp = new OrderShipping();
            $shipp->order_id = $item->id_ordine;
            $shipp->nome = $item->nome;
            $shipp->cognome = $item->cognome;
            $shipp->email = $item->email;
            $shipp->telefono = $item->telefono;
            $shipp->indirizzo = $item->indirizzo;
            $shipp->cap = $item->cap;
            $shipp->citta = $item->citta;
            $shipp->provincia = $item->provincia;
            $shipp->nazione = $item->nazione;
            $shipp->save();
        }
        return back()->with('success','Spedizioni ordini sincronizzati!');
    }

    public function sync_users()
    {
        \DB::table('users')->truncate();
        \DB::table('clearpasswords')->truncate();

        $vecchi = \DB::table('tb_users')->get();

        foreach($vecchi as $item)
        {
            $email = $item->email;
            $name = $item->nome;
            $clear = \DB::table('tb_clear_pwd')->where('id_user',$item->id)->first();

            if($clear)
            {
                $clear_pwd = $clear->pwd;
                $new_pass = \Hash::make($clear_pwd);

                $user = new User();
                $user->name = $name;
                $user->surname = $item->cognome;
                $user->email = $email;
                $user->password = $new_pass;
                $user->save();

                $user_id = $user->id;
                $clear = new Clearpassword();
                $clear->user_id = $user_id;
                $clear->password = $clear_pwd;
                $clear->save();

            }
            else
            {
                continue;
            }
        }

        return back()->with('success','User sincronizzati!');
    }

    public function sync_user_details()
    {
        \DB::table('user_details')->truncate();

        $vecchi = \DB::table('tb_user_details')->get();

        foreach ($vecchi as $item)
        {
            $detail = new UserDetail();
            $detail->user_id = $item->id_user;
            if($item->data_nascita != '0000-00-00')
            {
                $detail->data_nascita = $item->data_nascita;
            }

            $detail->citta_nascita = $item->citta_nascita;
            $detail->save();
        }
        return back()->with('success','User details sincronizzati!');
    }

    public function sync_reviews()
    {
        \DB::table('reviews')->truncate();

        $vecchie = \DB::table('tb_guestbook')->get();

        foreach($vecchie as $item)
        {
            $review = new Review();
            $review->nome = $item->nome;
            $review->messaggio = $item->messaggio;
            if($item->data_evento != '' && $item->data_evento != null)
            {
                $review->data_evento = $item->data_evento;
            }
            $review->created_at = $item->data_inserimento;

            if($item->visibile == 'si')
            {
                $review->visibile = 1;
            }
            $review->save();
        }

        return back()->with('success','Recensioni aggiornate');
    }

    public function sync_categorie()
    {
        \DB::table('categories')->truncate();

        $vecchie = \DB::table('tb_categorie')->get();
        foreach ($vecchie as $item)
        {
            $category = new Category();
            $category->id = $item->id;
            $category->macrocategory_id = $item->id_categoria_liv1;
            $category->nome_it = $item->nome_it;
            $category->nome_en = $item->nome_en;
            $category->desc_it = $item->descrizione_it;
            $category->desc_en = $item->descrizione_en;
            $category->order = $item->ordine;
            $category->save();
        }

        return back()->with('success','Categorie sincronizzate!');
    }

    public function sync_url_categorie()
    {
        $urls = Url::where('urlable_type','App\Model\Category')->delete();

        $categories = Category::all();
        $langs = \Config::get('langs');
        foreach ($categories as $cat)
        {

            foreach ($langs as $lang)
            {
                $domain = Domain::where('locale',$lang)->first();
                /*try{
                    $url = new Url();
                    $url->domain_id = $domain->id;
                    $url->locale = $lang;
                    $url->slug = Str::slug( $cat->macrocategory->{'nome_'.$lang}.'-'.$cat->macrocategory->id.'-'.$cat->id, '-');
                    $url->urlable_id = $cat->id;
                    $url->urlable_type = 'App\Model\Category';
                    $url->save();
                }
                catch(\Exception $e)
                {
                    return back()->with('error',$e->getMessage());
                }*/
                try{
                    $url = new Url();
                    $url->domain_id = $domain->id;
                    $url->locale = $lang;
                    $url->slug = Str::slug( $cat->{'nome_'.$lang}, '-');
                    $url->urlable_id = $cat->id;
                    $url->urlable_type = 'App\Model\Category';
                    $url->save();
                }
                catch(\Exception $e)
                {
                    return back()->with('error',$e->getMessage());
                }
            }
        }

        return back()->with('success','Urls create con successo!');
    }

    public function sync_prodotti()
    {
        \DB::table('products')->truncate();

        $vecchi = \DB::table('tb_prodotti')->get();
        foreach ($vecchi as $item)
        {
            $product = new Product();
            $product->id = $item->id;
            $product->category_id = $item->id_categoria;
            $product->codice = $item->codice;
            $product->prezzo = $item->prezzo;
            $product->prezzo_scontato = $item->prezzo_scontato;
            $product->acquistabile = $item->acquistabile;
            $product->stock = $item->qta_stock;
            if($item->disponibilita == 'disponibile')
            {
                $product->availability_id = 1;
            }
            elseif($item->disponibilita == 'non_disponibile')
            {
                $product->availability_id = 2;
            }
            elseif($item->disponibilita == 'disponibile_a_breve')
            {
                $product->availability_id = 3;
            }
            else
            {
                $product->availability_id = 4;
            }
            $product->nome_it = $item->nome_it;
            $product->nome_en = $item->nome_en;
            $product->desc_it = ltrim(strip_tags($item->descrizione_it));
            $product->desc_en = ltrim(strip_tags($item->descrizione_en));
            $product->desc_breve_it = ltrim(strip_tags($item->descrizione_breve_it));
            $product->desc_breve_en = ltrim(strip_tags($item->descrizione_breve_en));
            $product->misure_it = ltrim(strip_tags($item->dimensioni_it));
            $product->misure_en = ltrim(strip_tags($item->dimensioni_en));
            $product->peso = $item->peso;

            $product->visibile = ($item->visibile == 'si') ? 1:0;
            $product->italfama = ($item->visibile_su_italfama == 'si') ? 1:0;
            $product->novita = ($item->novita == 'si') ? 1:0;
            $product->offerta = ($item->offerta == 'si') ?1:0;
            $product->save();

        }
        return back()->with('success','Prodotti sincronizzati!');
    }

    public function sync_url_prodotti()
    {
        $urls = Url::where('urlable_type','App\Model\Product')->delete();

        $products = Product::all();
        $langs = \Config::get('langs');
        foreach ($products as $product)
        {

            foreach ($langs as $lang)
            {
                $domain = Domain::where('locale',$lang)->first();
                try{
                    $url = new Url();
                    $url->domain_id = $domain->id;
                    $url->locale = $lang;
                    $url->slug = trans('msg.dettaglio',[],$lang).'-'.$product->id;
                    $url->urlable_id = $product->id;
                    $url->urlable_type = 'App\Model\Product';
                    $url->save();
                }
                catch(\Exception $e)
                {
                    return back()->with('error',$e->getMessage());
                }
            }
        }

        return back()->with('success','Urls create con successo!');
    }

    public function sync_file_prodotti()
    {
        $files = File::where('fileable_type','App\Model\Product')->delete();
        $vecchi = \DB::table('tb_prodotti')->get();
        foreach ($vecchi as $item)
        {
            if($item->img_1 != '')
            {
                $file = new File();
                $file->path = $item->img_1;
                $file->fileable_id = $item->id;
                $file->fileable_type = 'App\Model\Product';
                $file->save();
            }
            if($item->img_2 != '')
            {
                $file = new File();
                $file->path = $item->img_2;
                $file->fileable_id = $item->id;
                $file->fileable_type = 'App\Model\Product';
                $file->save();
            }
            if($item->img_3 != '')
            {
                $file = new File();
                $file->path = $item->img_3;
                $file->fileable_id = $item->id;
                $file->fileable_type = 'App\Model\Product';
                $file->save();
            }
            if($item->img_4 != '')
            {
                $file = new File();
                $file->path = $item->img_4;
                $file->fileable_id = $item->id;
                $file->fileable_type = 'App\Model\Product';
                $file->save();
            }
            if($item->img_5 != '')
            {
                $file = new File();
                $file->path = $item->img_5;
                $file->fileable_id = $item->id;
                $file->fileable_type = 'App\Model\Product';
                $file->save();
            }
        }
        return back()->with('success','Immagini Prodotti sincronizzati!');
    }

    public function sync_abbinamenti()
    {
        \DB::table('pairings')->truncate();
        $vecchi = \DB::table('tb_abbinamenti')->get();
        foreach ($vecchi as $item)
        {
            $pairing = new Pairing();
            $pairing->id = $item->id;
            $pairing->category_id = $item->id_tipologia;
            $pairing->product1_id = $item->id_prodotto1;
            $pairing->product2_id = $item->id_prodotto2;
            if($item->stile_per_filtro == 'Set Tradizionali da Gioco' )
            {
                $pairing->style_id = 1;
            }
            elseif ($item->stile_per_filtro == 'Set Classici')
            {
                $pairing->style_id = 2;
            }
            elseif ($item->stile_per_filtro == 'Set Moderni')
            {
                $pairing->style_id = 3;
            }
            else
            {
                $pairing->style_id = 4;
            }
            $pairing->nome_it = $item->titolo;
            $pairing->nome_en = $item->titolo_en;
            $pairing->desc_it = ltrim(strip_tags($item->descrizione));
            $pairing->desc_en = ltrim(strip_tags($item->descrizione_en));
            $pairing->visibile = ($item->visibile == 'si') ? 1:0;
            $pairing->italfama = ($item->visibile_su_italfama == 'si') ? 1:0;
            $pairing->novita = ($item->novita == 'si') ? 1:0;
            $pairing->offerta = ($item->offerta == 'si') ?1:0;
            $pairing->save();

        }
        return back()->with('success','Abbinamenti sincronizzati!');
    }

    public function sync_file_abbinamenti()
    {
        $files = File::where('fileable_type','App\Model\Pairing')->delete();
        $vecchi = \DB::table('tb_abbinamenti')->get();
        foreach ($vecchi as $item)
        {
            if($item->img != '')
            {
                $file = new File();
                $file->path = $item->img;
                $file->fileable_id = $item->id;
                $file->fileable_type = 'App\Model\Pairing';
                $file->save();
            }
            if($item->img_2 != '')
            {
                $file = new File();
                $file->path = $item->img_2;
                $file->fileable_id = $item->id;
                $file->fileable_type = 'App\Model\Pairing';
                $file->save();
            }
            if($item->img_3 != '')
            {
                $file = new File();
                $file->path = $item->img_3;
                $file->fileable_id = $item->id;
                $file->fileable_type = 'App\Model\Pairing';
                $file->save();
            }
            if($item->img_4 != '')
            {
                $file = new File();
                $file->path = $item->img_4;
                $file->fileable_id = $item->id;
                $file->fileable_type = 'App\Model\Pairing';
                $file->save();
            }

        }
        return back()->with('success','Immagini Abbinamenti sincronizzati!');
    }

    public function sync_url_abbinamenti()
    {
        $urls = Url::where('urlable_type','App\Model\Pairing')->delete();

        $pairings = Pairing::all();
        $langs = \Config::get('langs');
        foreach ($pairings as $pairing)
        {

            foreach ($langs as $lang)
            {
                $domain = Domain::where('locale',$lang)->first();
                try{
                    $url = new Url();
                    $url->domain_id = $domain->id;
                    $url->locale = $lang;
                    $url->slug = trans('msg.dettaglio_abbinamento',[],$lang).'-'.$pairing->id;
                    $url->urlable_id = $pairing->id;
                    $url->urlable_type = 'App\Model\Pairing';
                    $url->save();
                }
                catch(\Exception $e)
                {
                    return back()->with('error',$e->getMessage());
                }
            }
        }

        return back()->with('success','Urls create con successo!');
    }

    public function create_thumbs(Request $request)
    {
        $per_page = 10;
        $page = ($request->page) ? $request->page : 1;
        $offset = $per_page * $page;

        $allfiles = File::where('fileable_type','App\Model\Product')->get();

        $numero_files = $allfiles->count();
        $pagine = ceil($numero_files/$per_page);

        $files = File::where('fileable_type','App\Model\Product')->offset($offset)->limit($per_page)->get();

        foreach ($files as $file)
        {
            //prendo il file di configurazione del modulo Product
            $productModule = Module::where('nome','prodotti')->first();
            $moduleConfigs = ModuleConfig::where('module_id',$productModule->id)->get();
            $uploadImgConfig = $moduleConfigs->where('nome','upload_image')->first();
            $upload_config = json_decode($uploadImgConfig->value);
            //---//

            $resizes = explode(',',$upload_config->resize);

            //faccio 2 resize come il vecchio sito e le chiamo big e small
            $small = $resizes[0];
            $big = $resizes[1];

            //la small
            $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/'.$file->path);
            $path = $_SERVER['DOCUMENT_ROOT'].'/file/small/'.$file->path;
            $img->resize($small, null, function ($constraint) {$constraint->aspectRatio();});
            $img->save($path);

            //la big
            $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/'.$file->path);
            $path = $_SERVER['DOCUMENT_ROOT'].'/file/big/'.$file->path;
            $img->resize($big, null, function ($constraint) {$constraint->aspectRatio();});
            $img->save($path);
        }

        $params = [
            'page'=>$page,
            'per_page'=>$per_page,
            'numero_files'=>$numero_files,
            'title_page' => 'Crea Thumbs',
            'pagine' => $pagine,
        ];
        return view('cms.sync.create_thumb',$params);
    }

    public function create_watermarks(Request $request)
    {
        $per_page = 10;
        $page = ($request->page) ? $request->page : 1;
        $offset = $per_page * $page;

        $allfiles = File::where('fileable_type','App\Model\Product')->get();
        $numero_files = $allfiles->count();
        $pagine = ceil($numero_files/$per_page);

        $files = File::where('fileable_type','App\Model\Product')->offset($offset)->limit($per_page)->get();

        foreach ($files as $file)
        {
            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/file/small/'.$file->path))
            {
                $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/small/'.$file->path);

                /* insert watermark at bottom-right corner with 10px offset */
                $img->insert($_SERVER['DOCUMENT_ROOT'].'/img/watermark_small.png', 'bottom-right', 50, 50);

                $img->save($_SERVER['DOCUMENT_ROOT'].'/file/wmc/small/'.$file->path);
            }

            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/file/big/'.$file->path))
            {
                $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/big/'.$file->path);

                /* insert watermark at bottom-right corner with 10px offset */
                $img->insert($_SERVER['DOCUMENT_ROOT'].'/img/watermark.png', 'bottom-right', 50, 50);

                $img->save($_SERVER['DOCUMENT_ROOT'].'/file/wmc/big/'.$file->path);
            }

        }

        $params = [
            'page'=>$page,
            'per_page'=>$per_page,
            'numero_files'=>$numero_files,
            'title_page' => 'Crea Watermark',
            'pagine' => $pagine,
        ];
        return view('cms.sync.create_watermarks',$params);
    }

    public function create_watermarks_ital(Request $request)
    {
        $per_page = 5;
        $page = ($request->page) ? $request->page : 1;
        $offset = $per_page * $page;

        $allfiles = File::where('fileable_type','App\Model\Product')->get();
        $numero_files = $allfiles->count();
        $pagine = ceil($numero_files/$per_page);

        $files = File::where('fileable_type','App\Model\Product')->offset($offset)->limit($per_page)->get();

        foreach ($files as $file)
        {
            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/file/small/'.$file->path))
            {
                $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/small/'.$file->path);

                /* insert watermark at bottom-right corner with 10px offset */
                $img->insert($_SERVER['DOCUMENT_ROOT'].'/img/watermark2_small.png', 'bottom-right', 50, 50);

                $img->save($_SERVER['DOCUMENT_ROOT'].'/file/wmi/small/'.$file->path);
            }

            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/file/big/'.$file->path))
            {
                $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/big/'.$file->path);

                /* insert watermark at bottom-right corner with 10px offset */
                $img->insert($_SERVER['DOCUMENT_ROOT'].'/img/watermark2.png', 'bottom-right', 50, 50);

                $img->save($_SERVER['DOCUMENT_ROOT'].'/file/wmi/big/'.$file->path);
            }

        }

        $params = [
            'page'=>$page,
            'per_page'=>$per_page,
            'numero_files'=>$numero_files,
            'title_page' => 'Crea Watermark',
            'pagine' => $pagine,
        ];
        return view('cms.sync.create_watermarks_ital',$params);
    }

    public function create_thumbs_abbinamenti(Request $request)
    {
        $per_page = 10;
        $page = ($request->page) ? $request->page : 1;
        $offset = $per_page * $page;

        $allfiles = File::where('fileable_type','App\Model\Pairing')->get();
        $numero_files = $allfiles->count();
        $pagine = ceil($numero_files/$per_page);

        $files = File::where('fileable_type','App\Model\Pairing')->offset($offset)->limit($per_page)->get();

        foreach ($files as $file)
        {
            //prendo il file di configurazione del modulo Product
            $productModule = Module::where('nome','prodotti')->first();
            $moduleConfigs = ModuleConfig::where('module_id',$productModule->id)->get();
            $uploadImgConfig = $moduleConfigs->where('nome','upload_image')->first();
            $upload_config = json_decode($uploadImgConfig->value);
            //---//

            $resizes = explode(',',$upload_config->resize);

            //faccio 2 resize come il vecchio sito e le chiamo big e small
            $small = $resizes[0];
            $big = $resizes[1];

            //la small
            $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/'.$file->path);
            $path = $_SERVER['DOCUMENT_ROOT'].'/file/small/'.$file->path;
            $img->resize($small, null, function ($constraint) {$constraint->aspectRatio();});
            $img->save($path);

            //la big
            $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/'.$file->path);
            $path = $_SERVER['DOCUMENT_ROOT'].'/file/big/'.$file->path;
            $img->resize($big, null, function ($constraint) {$constraint->aspectRatio();});
            $img->save($path);
        }

        $params = [
            'page'=>$page,
            'per_page'=>$per_page,
            'numero_files'=>$numero_files,
            'title_page' => 'Crea Thumbs',
            'pagine' => $pagine,
        ];
        return view('cms.sync.create_thumb_abbinamenti',$params);
    }

    public function create_watermarks_abbinamenti(Request $request)
    {
        $per_page = 10;
        $page = ($request->page) ? $request->page : 1;
        $offset = $per_page * $page;

        $allfiles = File::where('fileable_type','App\Model\Pairing')->get();
        $numero_files = $allfiles->count();
        $pagine = ceil($numero_files/$per_page);


        $files = File::where('fileable_type','App\Model\Pairing')->offset($offset)->limit($per_page)->get();

        foreach ($files as $file)
        {
            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/file/small/'.$file->path))
            {
                $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/small/'.$file->path);

                /* insert watermark at bottom-right corner with 10px offset */
                $img->insert($_SERVER['DOCUMENT_ROOT'].'/img/watermark_small.png', 'bottom-right', 50, 50);

                $img->save($_SERVER['DOCUMENT_ROOT'].'/file/wmc/small/'.$file->path);
            }

            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/file/big/'.$file->path))
            {
                $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/big/'.$file->path);

                /* insert watermark at bottom-right corner with 10px offset */
                $img->insert($_SERVER['DOCUMENT_ROOT'].'/img/watermark.png', 'bottom-right', 50, 50);

                $img->save($_SERVER['DOCUMENT_ROOT'].'/file/wmc/big/'.$file->path);
            }

        }

        $params = [
            'page'=>$page,
            'per_page'=>$per_page,
            'numero_files'=>$numero_files,
            'title_page' => 'Crea Watermark',
            'pagine' => $pagine,
        ];
        return view('cms.sync.create_watermarks_abbinamenti',$params);
    }

    public function create_watermarks_ital_abbinamenti(Request $request)
    {
        $per_page = 5;
        $page = ($request->page) ? $request->page : 1;
        $offset = $per_page * $page;


        $allfiles = File::where('fileable_type','App\Model\Pairing')->get();
        $numero_files = $allfiles->count();
        $pagine = ceil($numero_files/$per_page);

        $files = File::where('fileable_type','App\Model\Pairing')->offset($offset)->limit($per_page)->get();

        foreach ($files as $file)
        {
            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/file/small/'.$file->path))
            {
                $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/small/'.$file->path);

                /* insert watermark at bottom-right corner with 10px offset */
                $img->insert($_SERVER['DOCUMENT_ROOT'].'/img/watermark2_small.png', 'bottom-right', 50, 50);

                $img->save($_SERVER['DOCUMENT_ROOT'].'/file/wmi/small/'.$file->path);
            }

            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/file/big/'.$file->path))
            {
                $img = Image::make($_SERVER['DOCUMENT_ROOT'].'/file/big/'.$file->path);

                /* insert watermark at bottom-right corner with 10px offset */
                $img->insert($_SERVER['DOCUMENT_ROOT'].'/img/watermark2.png', 'bottom-right', 50, 50);

                $img->save($_SERVER['DOCUMENT_ROOT'].'/file/wmi/big/'.$file->path);
            }

        }

        $params = [
            'page'=>$page,
            'per_page'=>$per_page,
            'numero_files'=>$numero_files,
            'title_page' => 'Crea Watermark',
            'pagine' => $pagine,
        ];
        return view('cms.sync.create_watermarks_ital_abbinamenti',$params);
    }


}
