<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'i@admin.com'
        ]);

        User::factory(29)->create();
        Category::factory(12)->create();
        Recipe::factory(100)->create();
        Tag::factory(40)->create();

        $recipes = Recipe::all();
        $tags = Tag::all();

        foreach ($recipes as $recipe) {
            $recipe->tags()->attach($tags->random(rand(2,4)));
        }
    }
}
