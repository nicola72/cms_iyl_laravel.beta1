<?php
namespace App\Http\Controllers\Cms;

use App\Model\Category;
use App\Model\Domain;
use App\Model\File;
use App\Model\Macrocategory;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Pairing;
use App\Model\Product;
use App\Model\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        foreach($orders as $order)
        {
            if($order->user_id)
            {

            }
        }
        $params = [
            'title_page' => 'Ordini',
            'orders' => $orders,
        ];
        return view('cms.order.index',$params);
    }

    public function order(Request $request,$id)
    {
        $order = Order::find($id);

        $params = [
            'title_page' => 'Ordine '.$order->id,
            'order' => $order
        ];

        return view('cms.order.order',$params);
    }
}