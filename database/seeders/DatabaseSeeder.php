<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Motorcycle;
use App\Models\RentalPackage;
use App\Models\Rental;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create customers.
        Customer::factory(10)->create();

        // Create motorcycles.
        Motorcycle::factory(10)->create();

        // Create three rental packages.
        RentalPackage::create([
            'name' => 'Daily Package',
            'duration_days' => 1,
            'price' => 500,
            'description' => 'One-day motorcycle rental.',
            'is_active' => true,
        ]);

        RentalPackage::create([
            'name' => 'Weekend Package',
            'duration_days' => 2,
            'price' => 900,
            'description' => 'Two-day motorcycle rental.',
            'is_active' => true,
        ]);

        RentalPackage::create([
            'name' => 'Weekly Package',
            'duration_days' => 7,
            'price' => 3000,
            'description' => 'Seven-day motorcycle rental.',
            'is_active' => true,
        ]);

        $customers = Customer::all();
        $motorcycles = Motorcycle::all();
        $packages = RentalPackage::all();

        // Create sample rentals using existing records.
        for ($i = 0; $i < 5; $i++) {
            $rental = Rental::create([
                'customer_id' => $customers[$i]->id,
                'motorcycle_id' => $motorcycles[$i]->id,
                'rental_package_id' => $packages[$i % 3]->id,
                'start_date' => now()->subDays($i)->toDateString(),
                'end_date' => now()->addDays(1 + $i)->toDateString(),
                'total_amount' => $packages[$i % 3]->price,
                'status' => $i === 0 ? 'active' : 'pending',
                'notes' => 'Sample rental record.',
            ]);

            // Record a payment for each sample rental.
            Payment::create([
                'rental_id' => $rental->id,
                'amount' => $rental->total_amount,
                'payment_date' => now()->toDateString(),
                'method' => ['cash', 'gcash', 'bank_transfer', 'card', 'cash'][$i],
                'reference_number' => 'SAMPLE-' . ($i + 1),
                'status' => 'paid',
            ]);

            if ($i === 0) {
                $motorcycles[$i]->update(['status' => 'rented']);
            }
        }
    }
}