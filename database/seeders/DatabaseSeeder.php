<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Wilaya;
use App\Models\Commune;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // // Create 10 categories with random images
        // $categories = Category::factory(10)->create()->each(function ($category) {
        //     // Ensure the category has an image, or assign a default placeholder

        //     $category->update(['image_url' => asset('storage/categories/default.png')]);
        // });

        // // Create 50 products and associate them with random categories
        // Product::factory(50)->create()->each(function ($product) use ($categories) {
        //     $product->categories()->attach($categories->random(5)->pluck('id')); // Attach 5 random categories
        //     $product->update(['image_url' => asset('storage/products/default.png')]);
        // });

        // // Create 100 clients
        // Client::factory(100)->create();

        // // Seed 10 communes per wilaya
        // Wilaya::all()->each(function ($wilaya) {
        //     Commune::factory()->count(10)->create([
        //         'wilaya_code' => $wilaya->wilaya_code
        //     ]);
        // });

        // Create 100 orders with optional statuses
        Order::factory(100)->create()->each(function ($order) {});
    }
}
