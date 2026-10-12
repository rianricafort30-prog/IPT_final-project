<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RentalPackageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Daily Package', 'Weekend Package', 'Weekly Package'
            ]),
            'duration_days' => fake()->randomElement([1, 2, 7]),
            'price' => fake()->randomElement([500, 900, 3000]),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}