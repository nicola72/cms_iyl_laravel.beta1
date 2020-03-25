<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $domain = $request->getHttpHost();
        echo $domain;
        //return view('website.page.index');
    }

    public function page(Request $request)
    {
        $slug = $request->segment(2);
        echo \App::getLocale();
    }
}
