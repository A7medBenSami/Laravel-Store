<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Home()
    {
        $products = Product::with('category')->active()->latest()->limit(8)->get();
        return view('front.home',compact('products'));
    }
}
