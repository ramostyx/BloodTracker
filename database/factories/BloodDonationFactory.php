<?php

namespace Database\Factories;

use App\Models\BloodStock;
use App\Models\Donor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BloodDonation>
 */
class BloodDonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'donor_id' => function () {
                return Donor::all()->random()->id;
            },
            'blood_stock_id' => function () {
                return BloodStock::all()->random()->id;
            },
            'quantity' => fake()->numberBetween(1,2),
        ];
    }
}
