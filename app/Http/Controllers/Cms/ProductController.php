<?php

namespace App\Http\Controllers\Cms;

use App\Model\Availability;
use App\Model\Category;
use App\Model\File;
use App\Model\Module;
use App\Model\ModuleConfig;
use App\Model\Product;
use App\Model\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $params = [
            'title_page' => 'Prodotti',
            'products' => $products,
        ];
        return view('cms.product.index',$params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = Category::all();
        $availabilities = Availability::all();
        $params = [
            'form_name' => 'form_create_product',
            'title_page'=> 'Nuovo Prodotto',
            'categorie' => $categorie,
            'availabilities' => $availabilities,
        ];
        return view('cms.product.create',$params);
    }


    public function store(Request $request)
    {
        $langs = \Config::get('langs');
        $prezzo_scontato = ($request->prezzo_scontato != '') ? $request->prezzo_scontato : 0;

        try{
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->availability_id = $request->availability_id;
            $product->codice = $request->codice;
            $product->prezzo = str_replace(',','.',$request->prezzo);
            $product->prezzo_scontato = str_replace(',','.',$prezzo_scontato);
            $product->acquistabile = $request->acquistabile;
            $product->acquistabile_italfama = $request->acquistabile_italfama;
            $product->peso = $request->peso;
            $product->stock = $request->stock;
            $product->novita = $request->novita;
            $product->offerta = $request->offerta;
            $product->visibile = $request->visibile;
            $product->italfama = $request->italfama;
            foreach ($langs as $lang)
            {
                $product->{'nome_'.$lang} = $request->{'nome_'.$lang};
                $product->{'desc_'.$lang} = $request->{'desc_'.$lang};
                $product->{'desc_breve_'.$lang} = $request->{'desc_breve_'.$lang};
                $product->{'misure_'.$lang} = $request->{'misure_'.$lang};

            }
            $product->save();
            $product_id = $product->id;

        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }

        $url = route('cms.prodotti');
        return ['result' => 1,'msg' => 'Elemento creato con successo!','url' => $url];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = Category::all();
        $availabilities = Availability::all();

        $product = Product::find($id);
        $params = [
            'title_page' => 'Modifica Prodotto '.$product->codice,
            'product' => $product,
            'categorie' => $categorie,
            'availabilities' => $availabilities,
            'form_name' => 'form_edit_product'
        ];

        return view('cms.product.edit',$params);
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $prezzo_scontato = ($request->prezzo_scontato != '') ? $request->prezzo_scontato : 0;

        $langs = \Config::get('langs');

        try{

            $product->category_id = $request->category_id;
            $product->availability_id = $request->availability_id;
            $product->codice = $request->codice;
            $product->prezzo = str_replace(',','.',$request->prezzo);
            $product->prezzo_scontato = str_replace(',','.',$prezzo_scontato);
            $product->acquistabile = $request->acquistabile;
            $product->acquistabile_italfama = $request->acquistabile_italfama;
            $product->peso = $request->peso;
            $product->stock = $request->stock;
            foreach ($langs as $lang)
            {
                $product->{'nome_'.$lang} = $request->{'nome_'.$lang};
                $product->{'desc_'.$lang} = $request->{'desc_'.$lang};
                $product->{'desc_breve_'.$lang} = $request->{'desc_breve_'.$lang};
                $product->{'misure_'.$lang} = $request->{'misure_'.$lang};
            }
            $product->save();

        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }

        $url = route('cms.prodotti');
        return ['result' => 1,'msg' => 'Elemento aggiornato con successo!','url' => $url];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        //elimino anche le url associate al prodotto
        $urls = Url::where('urlable_id',$product->id)->where('urlable_type','App\Model\Product')->get();
        foreach ($urls as $url)
        {
            $url->delete();
        }

        return back()->with('success','Elemento cancellato!');
    }

    public function images(Request $request, $id)
    {
        $product = Product::find($id);

        $images = File::where('fileable_id',$id)->where('fileable_type','App\Model\Product')->get();

        $params = [
            'title_page' => 'Immagini Prodotto '.$product->codice,
            'images' => $images,
            'product' => $product,
            'limit_max_file' =>false,
            'max_numero_file'=> 10,
            'max_file_size' => 2,
            'file_restanti' => 5,
            'extensions'=>'.jpg,.png',

        ];
        return view('cms.product.images',$params);
    }

    public function upload_images(Request $request)
    {
        //prendo il file di configurazione del modulo Product
        $productModule = Module::where('nome','prodotti')->first();
        $moduleConfigs = ModuleConfig::where('module_id',$productModule->id)->get();

        $uploadImgConfig = $moduleConfigs->where('nome','upload_image')->first();
        $upload_config = json_decode($uploadImgConfig->value);
        //---//

        $fileable_id = $request->fileable_id;
        $fileable_type = 'App\Model\Product';
        $allowed = ['jpg','jpeg','png','JPG'];
        $max_file_size = 2000000;

        //$path = $request->file('file')->store('avatars');

        $uploadedFile = $request->file('file');
        $filename = time().$uploadedFile->getClientOriginalName();

        try{
            \Storage::disk('file')->putFileAs('', $uploadedFile, $filename);
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }

        //se CROP configurato
        if($upload_config->crop)
        {
            \Image::make($image->getRealPath())->resize(200, 200)->save($path);
        }
        //---//

        //inserisco il nome del file nel db
        try{
            $file = new File();
            $file->path = $filename;
            $file->fileable_id = $fileable_id;
            $file->fileable_type = $fileable_type;
            $file->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }


        $url = route('cms.prodotti');
        return ['result' => 1,'msg' => 'File caricato con successo!','url' => $url];
    }

    public function switch_visibility(Request $request)
    {
        $id = $request->id;
        $stato = $request->stato;

        try{
            $item = Product::find($id);
            $item->visibile = $stato;
            $item->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }
        return ['result' => 1,'msg' => 'Elemento aggiornato con successo!'];

    }

    public function switch_visibility_italfama(Request $request)
    {
        $id = $request->id;
        $stato = $request->stato;

        try{
            $item = Product::find($id);
            $item->italfama = $stato;
            $item->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }
        return ['result' => 1,'msg' => 'Elemento aggiornato con successo!'];

    }

    public function switch_offerta(Request $request)
    {
        $id = $request->id;
        $stato = $request->stato;

        try{
            $item = Product::find($id);
            $item->offerta = $stato;
            $item->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }
        return ['result' => 1,'msg' => 'Elemento aggiornato con successo!'];

    }

    public function switch_novita(Request $request)
    {
        $id = $request->id;
        $stato = $request->stato;

        try{
            $item = Product::find($id);
            $item->novita = $stato;
            $item->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }
        return ['result' => 1,'msg' => 'Elemento aggiornato con successo!'];

    }
}
