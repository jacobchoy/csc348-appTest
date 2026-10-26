<?php

namespace Database\Factories;

use App\Models\Lavatory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lavatory>
 */
class LavatoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'location' => fake()->randomElement(['Front-One', 'Front-Two', 'Mid-One', 'Middle-Two', 'Rear-One', 'Rear-Two']),
            'status' => fake()->randomElement(['vacant', 'occupied', 'out_of_service']),
            'gender_type' => fake()->randomElement(['unisex', 'accessible']),
        ];
    }
}
