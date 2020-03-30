<?php

namespace App\Http\Controllers\Website;

use App\Model\Page;
use Illuminate\Http\Request;
use App\Model\Url;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $domain = $request->getHttpHost();
        return view('website.page.index');
    }

    public function page(Request $request)
    {
        $slug = $request->segment(2);

        //prendo la url con quello slug e con la lingua
        $url = Url::where('slug',$slug)->where('locale',\App::getLocale())->first();
        if($url)
        {
            switch ($url->urlable_type) {
                case 'App\Model\Page':
                    return $this->simplePage($url);
                    break;
                case 'App\Model\Category':
                    return $this->categoryPage($url);
                    break;
                case 'App\Model\Product':
                    return $this->productPage($url);
                    break;
                default:
                    return view('website.errors.404');
            }
        }
        else
        {
            return view('website.errors.404');
        }
    }

    protected function simplePage($url)
    {
        $page = Page::find($url->urlable_id);
        if(method_exists($this,$page->nome))
        {
            return $this->{$page->nome};
        }
        else
        {
            return view('website.errors.not_found_method',['method'=>$page->nome]);
        }
    }

    protected function categoryPage($url)
    {

    }

    protected function productPage($url)
    {

    }
}
