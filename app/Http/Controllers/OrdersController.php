<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use App\services\orders\SaveOrderService;
class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $user=User::query()->with('orders.product.images')->find(auth()->id());
        $orders=$user->orders;
//        dd($user->orders);
//        $order=Orders::query()->where('user_id','=',auth()->id())->get();
//        dd($order);
//        dd($products[0]);
        return view('orders.index',compact('orders'));
    }
    public function add(Request $request,$product_id)
    {
        $quantity = $request->input('quantity');
//        if($product_id)
        SaveOrderService::make($quantity,$product_id);
        return redirect()->back()->with('success','item has been added to the cart');
    }
}
