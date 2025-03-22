<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Commune;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition()
    {
        $product = Product::inRandomOrder()->first();
        $quantity = fake()->numberBetween(1, 5);

        return [
            'client_id' => Client::inRandomOrder()->first()->id,
            'commune_id' => Commune::inRandomOrder()->first()->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity, // Calculate total price
            'delivery_method' => fake()->randomElement(['Door', 'StopDesk']),
            'status' => fake()->optional()->randomElement(['Pending', 'Confirmed', 'Canceled', 'Delivered']),
        ];
    }
}
