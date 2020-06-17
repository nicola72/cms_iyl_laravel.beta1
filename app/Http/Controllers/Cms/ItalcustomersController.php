<?php
namespace App\Http\Controllers\Cms;
use App\Model\Website\ItalUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class ItalcustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = ItalUser::all();
        $params = [
            'title_page' => 'Clienti Italfama',
            'customers' => $customers,
        ];
        return view('cms.italcustomers.index',$params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $params = [
            'form_name' => 'form_create_customers',
            'title_page'=> 'Nuovo Cliente Italfama',
        ];
        return view('cms.italcustomers.create',$params);
    }

    public function store(Request $request)
    {

        try{
            $customer = new ItalUser();
            $customer->name = $request->nome;
            $customer->email = $request->email;
            $customer->password = Hash::make($request->password);
            $customer->clear_pwd = $request->password;
            $customer->sconto = $request->sconto;
            $customer->tipo_sconto = $request->tipo_sconto;
            $customer->condizioni_cliente = $request->condizioni_cliente;
            $customer->condizioni_pagamento = $request->condizioni_pagamento;

            $customer->save();

        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }

        $url = route('cms.italfama_customers');
        return ['result' => 1,'msg' => 'Elemento creato con successo!','url' => $url];
    }

    public function edit($id)
    {

        $customer = ItalUser::find($id);
        $params = [
            'title_page' => 'Modifica Cliente '.$customer->nome,
            'customer' => $customer,
            'form_name' => 'form_edit_customer'
        ];

        return view('cms.italcustomers.edit',$params);
    }

    public function update(Request $request, $id)
    {
        $customer = ItalUser::find($id);

        try{

            $customer->name = $request->nome;
            $customer->email = $request->email;
            $customer->password = Hash::make($request->password);
            $customer->clear_pwd = $request->password;
            $customer->sconto = $request->sconto;
            $customer->tipo_sconto = $request->tipo_sconto;
            $customer->condizioni_cliente = $request->condizioni_cliente;
            $customer->condizioni_pagamento = $request->condizioni_pagamento;

            $customer->save();

        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }

        $url = route('cms.italfama_customers');
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
        $customer = ItalUser::find($id);
        $customer->delete();

        return back()->with('success','Elemento cancellato!');
    }

    public function switch_vede_p_fabbrica(Request $request)
    {
        $id = $request->id;
        $stato = $request->stato;

        try{
            $item = ItalUser::find($id);
            $item->vede_p_fabbrica = $stato;
            $item->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }
        return ['result' => 1,'msg' => 'Elemento aggiornato con successo!'];
    }

    public function switch_vede_p_vendita(Request $request)
    {
        $id = $request->id;
        $stato = $request->stato;

        try{
            $item = ItalUser::find($id);
            $item->vede_p_vendita = $stato;
            $item->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }
        return ['result' => 1,'msg' => 'Elemento aggiornato con successo!'];
    }

    public function switch_vede_p_netto(Request $request)
    {
        $id = $request->id;
        $stato = $request->stato;

        try{
            $item = ItalUser::find($id);
            $item->vede_p_netto = $stato;
            $item->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }
        return ['result' => 1,'msg' => 'Elemento aggiornato con successo!'];
    }

    public function switch_vede_sconto_bonifico(Request $request)
    {
        $id = $request->id;
        $stato = $request->stato;

        try{
            $item = ItalUser::find($id);
            $item->vede_sconto_bonifico = $stato;
            $item->save();
        }
        catch(\Exception $e){

            return ['result' => 0,'msg' => $e->getMessage()];
        }
        return ['result' => 1,'msg' => 'Elemento aggiornato con successo!'];
    }
}