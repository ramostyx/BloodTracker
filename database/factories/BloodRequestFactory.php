<?php

namespace Database\Factories;

use App\Models\BloodStock;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BloodRequest>
 */
class BloodRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_id' => function () {
                return Client::all()->random()->id;
            },
            'blood_stock_id' => function () {
                return BloodStock::all()->random()->id;
            },
            'quantity' => fake()->numberBetween(1,3),
        ];
    }
}
