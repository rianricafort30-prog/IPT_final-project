
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\RentalPackageController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PaymentController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('customers', CustomerController::class);

Route::resource('motorcycles', MotorcycleController::class);

Route::resource('rental-packages', RentalPackageController::class)
    ->parameters(['rental-packages' => 'rental_package']);

Route::resource('rentals', RentalController::class);

Route::resource('payments', PaymentController::class);
