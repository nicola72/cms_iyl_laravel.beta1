<?php

namespace App\Http\Controllers\Cms;

use App\Model\Category;
use App\Model\Pairing;
use App\Model\Product;
use App\Model\Style;
use App\Model\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PairingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $pairings = Pairing::all();
        $params = [
            'title_page' => 'Abbinamenti',
            'products' => $products,
            'pairings' => $pairings
        ];
        return view('cms.pairing.index',$params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //prendo le categorie con la macro Set Completi
        $categorie = Category::where('macrocategory_id',22)->get();
        $styles = Style::all();
        $products = Product::all();
        $params = [
            'form_name' => 'form_create_pairing',
            'title_page'=> 'Nuovo Abbinamento',
            'categorie' => $categorie,
            'products' => $products,
            'styles' => $styles,
        ];
        return view('cms.pairing.create',$params);
    }

    public function store(Request $request)
    {
        $langs = \Config::get('langs');
        //$product1 = Product::find($request->product1_id);
        //$product2 = Product::find($request->product2_id);

        try{
            $pairing = new Pairing();
            $pairing->category_id = $request->category_id;
            $pairing->style_id = $request->style_id;
            $pairing->product1_id = $request->product1_id;
            $pairing->product2_id = $request->product2_id;
            $pairing->novita = $request->novita;
            $pairing->offerta = $request->offerta;
            $pairing->visibile = $request->visibile;
            $pairing->italfama = $request->italfama;
            foreach ($langs as $lang)
            {
                $pairing->{'nome_'.$lang} = $request->{'nome_'.$lang};
                $pairing->{'desc_'.$lang} = $request->{'desc_'.$lang};
            }
            $pairing->save();
            $pairing_id = $pairing->id;

        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }

        $url = route('cms.abbinamenti');
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
        $pairing = Pairing::find($id);
        $pairing->delete();

        //elimino anche le url associate al prodotto
        $urls = Url::where('urlable_id',$pairing->id)->where('urlable_type','App\Model\Pairing')->get();
        foreach ($urls as $url)
        {
            $url->delete();
        }

        return back()->with('success','Elemento cancellato!');
    }
}
