<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->unique()->numerify('05########'), // Algerian phone format
            'total_orders' => 0,
            'amount_spent' => 0,
            'ip_address' => $this->faker->ipv4(),
            'note' => $this->faker->optional()->sentence(),
        ];
    }
}
