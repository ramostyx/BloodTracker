<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'post_id' => function () {
                return Post::all()->random()->id;
            },
            'startDate' => fake()->dateTime(),
            'endDate' => fake()->dateTime(),
            'location' => fake()->address(),
        ];
    }
}
