<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\Wilaya;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommuneFactory extends Factory
{
    protected $model = Commune::class;

    public function definition()
    {
        return [
            'wilaya_code' => Wilaya::inRandomOrder()->first()?->wilaya_code ?? 1, // Assign to a random wilaya
            'commune_name_ar' => fake()->city,
            'commune_name_fr' => fake()->city,
        ];
    }
}
