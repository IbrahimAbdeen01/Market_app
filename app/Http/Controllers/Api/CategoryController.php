<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct(
    private readonly CategoryService $categoryService
) {
}
    public function index()
    {
        $categories = $this->categoryService->getAll();
        return response()->json([
            'message' => 'success',
            'data'=> $categories,
        ]);
    }


    public function store(StoreCategoryRequest $request)
    { $category=$this->categoryService->store($request->validated());
        return response()->json([
            'message' => 'stored successfully',
            'data'=> $category,
        ]);
    }


    public function show(Category $category)
    {
        $category=$this->categoryService->getOne($category);
        return response()->json([
            'message' => 'success',
            'data'=> $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category=$this->categoryService->update($category,$request->validated());
        return response()->json([
            'message' => 'updated successfully',
            'data'=> $category,
        ]);

    }


    public function destroy(Category $category)
    {
        $category=$this->categoryService->delete($category);
        return response()->json([
            'message' => 'deleted successfully',
        ]);
    }
}
