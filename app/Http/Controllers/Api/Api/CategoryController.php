<?php

namespace App\Http\Controllers\Api\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(): CategoryCollection
    {
        return new CategoryCollection(Category::all());
    }

    public function show(Category $category): CategoryResource
    {
        $category = $category->load('recipes.category', 'recipes.tags', 'recipes.user');
        return new CategoryResource($category);
    }
}
