<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

public function __construct(
   private readonly ProductService $productService)
{
}

    public function index()
    { $products = $this->productService->getAll();


        return response()->json([
            'message' => 'success',
            'data'=> $products,
        ]);

    }


    public function store(StoreProductRequest $request)
    { $product=$this->productService->store($request->validated());


        return response()->json([
            'message' => 'stored successfully',
            'data'=> $product,
        ]);

    }


    public function show(Product $product)
    { $products = $this->productService->getOne($product);


        return response()->json([
        'message' => 'success',
        'data'=> $product,
    ]);
    }


    public function update(UpdateProductRequest $request, Product $product)
    {$product=$this->productService->update($product,$request->validated());


        return response()->json([
            'message' => 'updated successfully',
            'data'=> $product,
        ]);

    }


    public function destroy(Product $product)
    {
        $product=$this->productService->delete($product);

        return response()->json([
            'message' => 'deleted successfully',
            'data'=> $product,
        ]);
    }
}
