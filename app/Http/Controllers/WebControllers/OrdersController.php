<?php

namespace App\Http\Controllers\WebControllers;

use App\Models\User;
use App\services\orders\SaveOrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\WebControllers\Controller;

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
    public function checkout(Request $request)
    {
        $user=User::query()->with('orders.product')->find(auth()->id());
        $orders=$user->orders;
        return view('orders.checkout',[
            'user'=>$user,
            'orders'=>$orders
        ]);
    }
    public function confirmation(Request $request)
    {
        $user=User::query()->find(auth()->id());
//        dd($user);
        return view('orders.confirmation',compact('user'));
    }
}
