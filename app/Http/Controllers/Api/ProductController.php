<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\dashboard\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Product::filter($request->query())
        ->with('category:id,name', 'store:id,name')
        ->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'string|max:255',
            'category_id'=>'required|exists:categories,id',
            'status'=>'in:active,inactive',
            'price'=>'required|numeric|min:0',
            'compare_price'=> 'required|numeric|gt:price',

        ]);
        $user = Auth::guard('sanctum')->user();
        if (!$user->tokenCan('products.create')) {
            return response()->json([
                'message' => 'Not Allowed'
            ], 403);
        }
        $product = Product::create($request->all());
        return $product;

        //return response()->json($product, 201,[
            //'location'=>route('products.show',$product->id)
        //]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product
            ->load('category:id,name', 'store:id,name');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'string|max:255',
            'category_id' => 'sometimes|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'sometimes|numeric|min:0',
            'compare_price' => 'sometimes|numeric|gt:price',

        ]);
        $user = Auth::guard('sanctum')->user();
        if (!$user->tokenCan('products.update')) {
            return response()->json([
                'message' => 'Not Allowed'
            ], 403);
        }
        $product->update($request->all());
         return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = Auth::guard('sanctum')->user();
        if (!$user->tokenCan('products.delete')) {
             return response()->json([
                'message' =>'Not Allowed'
             ],403);
        }

        Product::destroy($id);
        return  [
            'message' => "The product with id {$id} has been deleted"
        ];
    }
}
