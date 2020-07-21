<?php

namespace App\Http\Controllers\Website;

use App\Model\Cart;
use App\Model\Category;
use App\Model\Domain;
use App\Model\File;
use App\Model\Macrocategory;
use App\Model\Material;
use App\Model\Page;
use App\Model\Pairing;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Model\Url;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{
    public function __construct()
    {

    }

    public function old_en_category(Request $request)
    {
        $macro_id = $request->get('categoria',false);
        $category_id = $request->get('sottocategoria',false);

        if(!$macro_id)
        {
            $url = 'https://www.chess-store.org';
        }

        if(!$category_id)
        {
            $urlObject = Url::where('urlable_type','App\Model\Macrocategory')->where('urlable_id',$macro_id)->where('locale','en')->first();

        }
        else
        {
            $urlObject = Url::where('urlable_type','App\Model\Category')->where('urlable_id',$category_id)->where('locale','en')->first();
        }

        if(!$urlObject)
        {
            $url = 'https://www.chess-store.org';
        }
        else
        {
            $url = 'https://www.chess-store.org/en/'.$urlObject->slug;
        }

        return redirect($url,301);
    }

    public function old_it_category(Request $request)
    {
        $macro_id = $request->get('categoria',false);
        $category_id = $request->get('sottocategoria',false);

        if(!$macro_id)
        {
            $url = 'https://www.chess-store.it';
        }

        if(!$category_id)
        {
            $urlObject = Url::where('urlable_type','App\Model\Macrocategory')->where('urlable_id',$macro_id)->where('locale','it')->first();

        }
        else
        {
            $urlObject = Url::where('urlable_type','App\Model\Category')->where('urlable_id',$category_id)->where('locale','it')->first();
        }

        if(!$urlObject)
        {
            $url = 'https://www.chess-store.it';
        }
        else
        {
            $url = 'https://www.chess-store.it/it/'.$urlObject->slug;
        }

        return redirect($url,301);
    }

    public function old_it_product(Request $request)
    {
        $product_id = $request->get('id_prodotto',false);
        $pairing_id = $request->get('id_abbinamento',false);
        if(!$product_id && !$pairing_id)
        {
            $url = 'https://www.chess-store.it';
        }

        if($product_id)
        {
            $urlObject = Url::where('urlable_type','App\Model\Product')->where('urlable_id',$product_id)->where('locale','it')->first();
        }
        else
        {
            $urlObject = Url::where('urlable_type','App\Model\Pairing')->where('urlable_id',$pairing_id)->where('locale','it')->first();
        }

        if(!$urlObject)
        {
            $url = 'https://www.chess-store.it';
        }
        else
        {
            $url = 'https://www.chess-store.it/it/'.$urlObject->slug;
        }

        return redirect($url,301);
    }

    public function old_en_product(Request $request)
    {
        $product_id = $request->get('id_prodotto',false);
        $pairing_id = $request->get('id_abbinamento',false);
        if(!$product_id && !$pairing_id)
        {
            $url = 'https://www.chess-store.org';
        }

        if($product_id)
        {
            $urlObject = Url::where('urlable_type','App\Model\Product')->where('urlable_id',$product_id)->where('locale','en')->first();
        }
        else
        {
            $urlObject = Url::where('urlable_type','App\Model\Pairing')->where('urlable_id',$pairing_id)->where('locale','en')->first();
        }

        if(!$urlObject)
        {
            $url = 'https://www.chess-store.org';
        }
        else
        {
            $url = 'https://www.chess-store.org/en/'.$urlObject->slug;
        }

        return redirect($url,301);
    }
}
