<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        $products=Product::with('category')->paginate(12);
        return view('front.products.index',compact('products'));

    }

    function show(Product $product)
    {
        if($product->status!='active')
        {
            return abort(404);
        }
        return view('front.products.show',compact('product'));
    }
}
