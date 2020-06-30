<?php
namespace App\Http\Controllers\Cms;

use App\Model\ItalOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade;


class ItalOrderController extends Controller
{
    public function index()
    {
        $orders = ItalOrder::all();

        $params = [
            'title_page' => 'Ordini Italfama',
            'orders' => $orders,
        ];
        return view('cms.ital_order.index',$params);
    }

    public function order(Request $request,$id)
    {
        $order = ItalOrder::find($id);

        $params = [
            'title_page' => 'Ordine Italfama '.$order->id,
            'order' => $order
        ];

        return view('cms.ital_order.order',$params);
    }

    public function pdf(Request $request, $id)
    {
        $order = ItalOrder::find($id);

        $params = [
            'title_page' => 'Ordine Italfama '.$order->id,
            'order' => $order
        ];

        $pdf = \PDF::loadView('cms.ital_order.order_pdf', $params);
        return $pdf->stream('ordine_'.$order->id.'.pdf');
    }
}
