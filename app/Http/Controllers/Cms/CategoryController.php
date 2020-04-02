<?php

namespace App\Http\Controllers\Cms;

use App\Model\Category;
use App\Model\Domain;
use App\Model\Macrocategory;
use App\Model\Product;
use App\Model\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorie = Category::orderBy('order', 'desc')->get();
        $params = [
            'title_page' => 'Categorie',
            'categorie' => $categorie,
        ];
        return view('cms.category.index',$params);
    }

    public function sync_categorie()
    {
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

        exit();
    }

    public function sync_url_categorie()
    {
        $categories = Category::all();
        $langs = \Config::get('langs');
        foreach ($categories as $cat)
        {

            foreach ($langs as $lang)
            {
                $domain = Domain::where('locale',$lang)->first();
                try{
                    $url = new Url();
                    $url->domain_id = $domain->id;
                    $url->locale = $lang;
                    $url->slug = Str::slug( $cat->macrocategory->{'nome_'.$lang}.'-'.$cat->{'nome_'.$lang}, '-');
                    $url->urlable_id = $cat->id;
                    $url->urlable_type = 'App\Model\Category';
                    $url->save();
                }
                catch(\Exception $e)
                {
                    return ['result' => 0,'msg' => $e->getMessage()];
                }
            }
        }
    }

    public function sync_prodotti()
    {
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
                $product->disponibilita = 1;
            }
            elseif($item->disponibilita == 'non_disponibile')
            {
                $product->disponibilita = 2;
            }
            elseif($item->disponibilita == 'disponibile_a_breve')
            {
                $product->disponibilita = 3;
            }
            else
            {
                $product->disponibilita = 4;
            }
            $product->nome_it = $item->nome_it;
            $product->nome_en = $item->nome_en;
            $product->desc_it = $item->descrizione_it;
            $product->desc_en = $item->descrizione_en;
            $product->desc_breve_it = $item->descrizione_breve_it;
            $product->desc_breve_en = $item->descrizione_breve_en;
            $product->misure_it = $item->dimensioni_it;
            $product->misure_en = $item->dimensioni_en;
            $product->peso = $item->peso;

            $product->visibile = ($item->visibile == 'si') ? 1:0;
            $product->italfama = ($item->visibile_su_italfama == 'si') ? 1:0;
            $product->novita = ($item->novita == 'si') ? 1:0;
            $product->offerta = ($item->offerta == 'si') ?1:0;
            $product->save();

        }
        exit();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $macros = Macrocategory::all();

        $params = [
            'form_name' => 'form_create_category',
            'macros' => $macros
        ];
        return view('cms.category.create',$params);
    }


    public function store(Request $request)
    {
        $langs = \Config::get('langs');

        try{
            $categoria = new Category();
            $categoria->macrocategory_id = $request->macrocategory_id;
            foreach ($langs as $lang)
            {
                $categoria->{'nome_'.$lang} = $request->{'nome_'.$lang};
                $categoria->{'desc_'.$lang} = $request->{'desc_'.$lang};
            }
            $categoria->save();
            $categoria_id = $categoria->id;

        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }

        $macro = Macrocategory::find($categoria->macrocategory_id);

        //1# Creo una url di default per ogni lingua
        foreach ($langs as $lang)
        {
            $domain = Domain::where('locale',$lang)->first();
            try{
                $url = new Url();
                $url->domain_id = $domain->id;
                $url->locale = $lang;
                $url->slug = Str::slug( $macro->{'nome_'.$lang}.'-'.$categoria->{'nome_'.$lang}, '-');
                $url->urlable_id = $categoria_id;
                $url->urlable_type = 'App\Model\Category';
                $url->save();
            }
            catch(\Exception $e)
            {
                return ['result' => 0,'msg' => $e->getMessage()];
            }
        }
        //1# Fine

        $url = url('/cms/category');
        return ['result' => 1,'msg' => 'Elemento inserito con successo!','url' => $url];
    }

    public function move_up(Request $request,$id)
    {
        $cat = Category::find($id);
        $cat->moveOrderUp();
        return back();
    }

    public function move_down(Request $request,$id)
    {
        $cat = Category::find($id);
        $cat->moveOrderDown();
        return back();
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
        $categoria = Category::find($id);
        $params = [
            'categoria' => $categoria,
            'form_name' => 'form_edit_categoria'
        ];

        return view('cms.category.edit',$params);
    }


    public function update(Request $request, $id)
    {
        $categoria = Category::find($id);

        $langs = \Config::get('langs');

        try{

            foreach ($langs as $lang)
            {
                $categoria->{'nome_'.$lang} = $request->{'nome_'.$lang};
                $categoria->{'desc_'.$lang} = $request->{'desc_'.$lang};
                $categoria->save();
            }

        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }

        $url = route('cms.categorie');
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
        return back()->with('error','Devo fare controllo prodotti presenti!');
        $categoria = Category::find($id);
        $categoria->delete();

        //elimino anche le url associate alla macro
        $urls = Url::where('urlable_id',$categoria->id)->where('urlable_type','App\Model\Category')->get();
        foreach ($urls as $url)
        {
            $url->delete();
        }

        return back()->with('success','Elemento cancellato!');
    }

    public function switch_stato(Request $request)
    {
        $id = $request->id;
        $stato = $request->stato;

        try{
            $item = Category::find($id);
            $item->stato = $stato;
            $item->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }
        return ['result' => 1,'msg' => 'Elemento aggiornato con successo!'];

    }
}