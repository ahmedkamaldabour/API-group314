<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiTrait;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    use ApiTrait;
    public function index()
    {
        $products = Product::get();
        return $this->apiResponse(200, 'All products', 'null', $products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->apiResponse(404, 'Product not found', 'Product not found', 'null');
        }
        return $this->apiResponse(200, 'Product found', 'null', $product);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:products,name'],
            'price' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        return $this->apiResponse(201, 'Product created', 'null', $product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->apiResponse(404, 'Product not found', 'Product not found', 'null');
        }
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:products,name,' . $id],
            'price' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(400, 'Validation error', $validator->errors(), 'null');
        }
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        return $this->apiResponse(200, 'Product updated', 'null', $product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->apiResponse(404, 'Product not found', 'Product not found', 'null');
        }
        $product->delete();
        return $this->apiResponse(200, 'Product deleted', 'null', 'null');
    }


}
