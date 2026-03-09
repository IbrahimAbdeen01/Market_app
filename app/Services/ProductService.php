<?php
namespace App\Services;
use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;
class ProductService{
    public function getAll()
    {
        return Product::query()->latest()->get();
    }
    public function getOne(Product $product)
    {
        return $product ;

    }
    public function store(array $data){
       return Product::create($data);
    }
    public function update(Product $product, array $data){
        $product->update($data);
        return $product->fresh();
    }
    public function delete(Product $product){
        return $product->delete();
    }
}
