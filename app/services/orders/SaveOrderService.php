<?php

namespace App\services\orders;
use App\Models\Orders;
use App\Models\Products;
class SaveOrderService
{
    public static function make($quantity,$product_id)
    {
        $product = Products::query()->find($product_id);
        if ($product) {
            $order=Orders::query()->where('product_id','=',$product_id)->where('user_id','=',auth()->id())->get();
//            dd($order);
            if(!(sizeof($order))) {
                Orders::query()->create([
                    'user_id' => auth()->id(),
                    'product_id' => $product_id,
                    'price' => $product->price, // Access price property directly
                    'quantity' => $quantity,
                ]);
            }
            else{
                return redirect()->back()->with('failed','item is already in the cart');
            }
        }
    }
}
