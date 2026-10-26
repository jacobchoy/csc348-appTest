<?php

namespace Database\Factories;

use App\Models\Lavatory;
use App\Models\LavatoryLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LavatoryLog>
 */
class LavatoryLogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'lavatory_id' => Lavatory::factory(),
            'user_id' => fake()->boolean(80) ? User::factory() : null,
            'status' => fake()->randomElement(['vacant', 'occupied', 'out_of_service']),
            'wait_time_minutes' => fake()->numberBetween(0, 30),
        ];
    }
}
