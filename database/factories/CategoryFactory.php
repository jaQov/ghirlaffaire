<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word,
            'slug' => fake()->unique()->slug,
            'image_url' => fake()->imageUrl(640, 480, 'categories'),
        ];
    }
}
