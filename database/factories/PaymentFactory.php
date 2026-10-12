<?php

namespace Database\Factories;

use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'rental_id' => Rental::factory(),
            'amount' => fake()->randomElement([500, 1000, 1500, 3000]),
            'payment_date' => fake()->date(),
            'method' => fake()->randomElement([
                'cash', 'gcash', 'bank_transfer', 'card'
            ]),
            'reference_number' => fake()->optional()->bothify('REF-########'),
            'status' => 'paid',
        ];
    }
}
