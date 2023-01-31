<?php

namespace Database\Factories;

use App\Models\BloodTransferCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'blood_transfer_id' => function () {
                return BloodTransferCenter::all()->random()->id;
            },
            'title' => fake()->sentence(),
            'body' => fake()->realText(15),
            'photo' => fake()->file(),

        ];
    }
}
