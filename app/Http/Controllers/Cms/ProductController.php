<?php

namespace App\Http\Controllers\Cms;

use App\Model\Availability;
use App\Model\Category;
use App\Model\Product;
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

        try{
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->availability_id = $request->availability_id;
            $product->codice = $request->codice;
            $product->prezzo = $request->prezzo;
            $product->prezzo_scontato = $request->prezzo_scontato;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
