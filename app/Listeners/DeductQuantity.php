<?php

namespace App\Listeners;

use App\facades\Cart;
use App\Models\dashboard\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\DB;



class DeductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;

       foreach (Cart::get() as $item) {

        Product::where('id','=',$item->product->id)
        ->update([
            'quantity'=>DB::raw("quantity -{$item->quantity}")
        ]);
       }
    }


}
