<?php

namespace App\Observers;

use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use App\Notifications\OrderNotification;
//use Illuminate\Support\Facades\Request;
//use Illuminate\Notifications\Notifiable;
//use App\Notifications\InvoicePaid;


class OrdersObserver
{
//    use Notifiable;
    /**
     * Handle the Orders "created" event.
     */
    public function created(Orders $orders): void
    {
        $product=Products::query()->where('id','=',$orders['product_id'])->first();
//        dd($product);
        $supplier=User::query()->where('id','=',$product['supplier_id'])->first();
        $supplier->notify(new OrderNotification($orders));
    }

    /**
     * Handle the Orders "updated" event.
     */
    public function updated(Orders $orders): void
    {
        //
    }

    /**
     * Handle the Orders "deleted" event.
     */
    public function deleted(Orders $orders): void
    {
        //
    }

    /**
     * Handle the Orders "restored" event.
     */
    public function restored(Orders $orders): void
    {
        //
    }

    /**
     * Handle the Orders "force deleted" event.
     */
    public function forceDeleted(Orders $orders): void
    {
        //
    }
}
