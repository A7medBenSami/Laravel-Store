<?php

namespace App\Models\dashboard;

use App\Models\dashboard\Product;
use App\Observers\CartObserve;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'user_id','product_id','coockie_id','quantity','option'
    ];

    // static function booted(){
    //     static::creating(function(Cart $cart){
    //         $cart->id = Str::uuid();
    //     });
    // }

    protected static function booted()
    {
        static::observe(CartObserve::class);

        static::addGlobalScope('coockie_id',function(Builder $builder){

            $builder->where('coockie_id', Cart::getCookieId());

        });
    }


    public static function getCookieId()
    {
        $coockie_id = \Cookie::get('cart_id');
        if (!$coockie_id) {
            $coockie_id = Str::uuid();
            \Cookie::queue('cart_id', $coockie_id, 30 * 24 * 60);
        }
        return $coockie_id;
    }


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest'
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
