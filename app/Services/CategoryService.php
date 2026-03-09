<?php
namespace App\Services;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Models\Category;
class CategoryService{
    public function getAll(){
        return Category::query()->latest()->get();
    }
    public function getOne(Category $category){
    return $category;
    }
    public function store(array $data)
    {
        return Category::create($data);
    }
    public function update(Category $category,array $data){
        $category->update($data);
        return $category->fresh();
    }
    public function delete(Category $category){
        return  $category->delete();
    }
}
