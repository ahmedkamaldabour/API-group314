<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StroeProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
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

    public function store(StroeProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        return $this->apiResponse(201, 'Product created', 'null', $product);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->apiResponse(404, 'Product not found', 'Product not found', 'null');
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
