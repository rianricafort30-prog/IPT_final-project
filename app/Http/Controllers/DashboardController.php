<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Motorcycle;
use App\Models\RentalPackage;
use App\Models\Rental;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $customerCount = Customer::count();
        $motorcycleCount = Motorcycle::count();
        $packageCount = RentalPackage::count();
        $rentalCount = Rental::count();

        $paymentTotal = Payment::where('status', 'paid')
            ->sum('amount');

        $recentRentals = Rental::with([
            'customer',
            'motorcycle'
        ])->latest()->take(5)->get();

        return view('dashboard', compact(
            'customerCount',
            'motorcycleCount',
            'packageCount',
            'rentalCount',
            'paymentTotal',
            'recentRentals'
        ));
    }
}
