<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Motorcycle;
use App\Models\RentalPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-10 days', '+5 days');
        $days = fake()->numberBetween(1, 5);

        return [
            'customer_id' => Customer::factory(),
            'motorcycle_id' => Motorcycle::factory(),
            'rental_package_id' => RentalPackage::factory(),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => (clone $start)->modify("+{$days} days")->format('Y-m-d'),
            'total_amount' => $days * 500,
            'status' => 'pending',
            'notes' => fake()->optional()->sentence(),
        ];
    }
}