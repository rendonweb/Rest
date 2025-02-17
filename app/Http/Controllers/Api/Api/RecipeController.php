<?php

namespace App\Http\Controllers\Api\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class RecipeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $recipes = Recipe::with('category', 'tags', 'user')->get();
        return RecipeResource::collection($recipes);
    }

    public function store(StoreRecipeRequest $request): JsonResponse
    {
        $recipe = Recipe::create($request->all());
        return response()->json(new RecipeResource($recipe), Response::HTTP_CREATED);
    }

    public function show(Recipe $recipe): RecipeResource
    {
        $recipe = $recipe->load('category', 'tags', 'user');
        return new RecipeResource($recipe);
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe): JsonResponse
    {
        $recipe->update($request->all());

        if ($tags = json_decode($request->tags)) {
            $recipe->tags()->sync($tags);
        }

        return response()->json(new RecipeResource($recipe), Response::HTTP_OK);
    }

    public function destroy(Recipe $recipe): JsonResponse
    {
        $recipe->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
