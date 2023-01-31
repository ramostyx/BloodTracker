<?php

namespace Database\Factories;

use App\Models\BloodStock;
use App\Models\BloodTransferCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BloodStock>
 */
class BloodStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'blood_transfer_center_id' => function () {
                return BloodTransferCenter::all()->random()->id;
            },
            'bloodType' => fake()->randomElement(['O-','O+','B-','B+','A-','A+','AB-','AB+']),
            'stock' => fake()->numberBetween(0,500),
            'capacity' => 500,
            'threshold' => fake()->numberBetween(100,200),
        ];

    }
}
