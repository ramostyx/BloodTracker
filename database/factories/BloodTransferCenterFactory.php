<?php

namespace Database\Factories;

use App\Models\BloodTransferCenter;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BloodTransferCenter>
 */
class BloodTransferCenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                $user = User::whereDoesntHave('bloodtransfercenter',function (Builder $query) {
                    $query->where('role', 'center');
                })->inRandomOrder()->first();


                if (!$user) {
                    $user = User::factory()->create(['role' => 'center']);
                }



                return $user->id;
            },
        ];
    }
}
