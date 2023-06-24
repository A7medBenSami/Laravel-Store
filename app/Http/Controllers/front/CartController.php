<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartRepository $cart){
        $this->middleware('auth');
        $this->cart = $cart;

    }
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart)
    {
        $item = $cart->get();
        return view('front.cart',[
            'cart'=>$cart
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity'=>['nullable','int','min:1']
        ]);
        $product = Product::findOrFail($request->post('product_id'));
        $this->cart->add($product,$request->post('quantity'));
        if($request->expectsJson()){
            return response()->json([
                'message'=>'Item Added To Cart !'
            ],201);
        }
        return redirect()->route('cart.index');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1']
        ]);

        $this->cart->update($id, $request->input('quantity'));

        return redirect()->route('cart.index');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cart->delete($id);
        return[
            'message'=> 'Item Deleted !',
        ];
    }


}

