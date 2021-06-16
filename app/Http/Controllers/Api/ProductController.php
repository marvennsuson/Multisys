<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    public function index(){
     return  ProductResource::collection(Product::all());
    }

    public function store(ProductRequest $request){
        $attributes =  $request->validated();
        $product = Product::create($attributes);

        return new ProductResource($product);
    }

    public function show(Product $product){
        // $product = Product::findOrFail($id);
        if(is_null($product)) {
            $response = ['status' => false, 'msg' => 'Product Not Found'];
            return response()->json($response, 401);
        }
        return new ProductResource($product);

    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return new ProductResource($product);
    }

    
    public function destroy(Product $product)
    {
        $product->delete();
    $response = ['status' => true, 'msg' => 'Product Deleted'];
           
        return response()->json($response, 200);
    }


}
