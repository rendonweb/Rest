<?php

use App\Http\Controllers\Api\Api\CategoryController;
use App\Http\Controllers\Api\Api\RecipeController;
use App\Http\Controllers\Api\Api\TagController;
use Illuminate\Support\Facades\Route;

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);

Route::apiResource('recipes', RecipeController::class);


Route::get('tags', [TagController::class, 'index']);
Route::get('tags/{tag}', [TagController::class, 'show']);
