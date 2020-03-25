<?php

namespace App\Http\Controllers\Cms;

use App\Model\Domain;
use App\Model\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulo = Module::where('nome','website')->first();
        $configs = $modulo->configs;

        $params = ['title_page' => 'Website','configs'=>$configs];
        return view('cms.website.index',$params);
    }

    public function domains()
    {
        $domains = Domain::all();
        $params = ['title_page' => 'Website Domini','domains'=>$domains];
        return view('cms.website.domains',$params);
    }

    public function create_domain()
    {
        $params = [
            'form_name' => 'form_create_domain',
        ];
        return view('cms.website.create_domain',$params);
    }

    public function store_domain(Request $request)
    {
        try{
            $domain = new Domain();
            $domain->nome = $request->nome;
            $domain->locale = $request->lang;
            $domain->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }

        $url = url('/cms/website/domains');
        return ['result' => 1,'msg' => 'Elemento inserito con successo!','url' => $url];
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
}
