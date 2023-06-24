<?php

namespace App\Models;

use App\Models\dashboard\Product;
use App\Models\dashboard\Store;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id','user_id','payment_method','status','payment_status', 'updated_at', 'created_at'
    ];

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'Guest'
        ]);
    }

        public function products()
    {
        return $this->belongsToMany(Product::class,'order_products','order_id','id','id')
        ->using(Order_Product::class)
        ->as('order_item')
        ->withPivot([
            'product_name','price','quantity','option'
        ]);
    }

    public function addresses()
    {
        return $this->belongsToMany(OrderAddresses::class, 'order_address', 'order_id', 'order_address_id');
    }


    public function billingAddress(){
    return $this->hasOne(OrderAddresses::class,'order_id','id')
        ->where('type','=','billing');
}
public function shippingAddress(){
    return $this->hasOne(OrderAddresses::class,'order_id','id')
        ->where('type','=','shipping');
}



    protected static function booted(){
        static::creating(function(Order $order){
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber(){

        $year = Carbon::now()->year;

        $number = Order::whereyear('created_at',$year)->max('number');
        if($number){
            return $number + 1;
        }
        return $year . '0001';
    }

}
