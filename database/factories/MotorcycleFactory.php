<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MotorcycleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'brand' => fake()->randomElement([
                'Honda', 'Yamaha', 'Suzuki', 'Kawasaki'
            ]),
            'model' => fake()->randomElement([
                'Click 125', 'Mio i125', 'Burgman Street', 'Raider 150'
            ]),
            'plate_number' => fake()->unique()->bothify('ABC-####'),
            'year' => fake()->numberBetween(2018, (int) date('Y')),
            'daily_rate' => fake()->randomElement([450, 500, 650, 800]),
            'status' => 'available',
            'description' => fake()->sentence(),
        ];
    }
}