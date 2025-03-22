<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'title' => fake()->word,
            'description' => fake()->sentence,
            'price' => fake()->numberBetween(100, 1000),
            'compare_at_price' => fake()->optional()->numberBetween(1100, 2000),
            'status' => fake()->boolean,
            'featured' => fake()->boolean,
            'inventory' => fake()->numberBetween(0, 100), // Ensure inventory is set
            'image_url' => fake()->imageUrl(640, 480, 'products'),
            'slug' => fake()->unique()->slug,
            'tags' => json_encode(fake()->words(3)),
        ];
    }
}
