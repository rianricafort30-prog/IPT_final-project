@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h2 class="mb-4">Motorcycle Rental Dashboard</h2>

<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Customers</h5>
                <h2>{{ $customerCount }}</h2>
                <a href="{{ route('customers.index') }}"
                   class="text-white">Manage Customers</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Motorcycles</h5>
                <h2>{{ $motorcycleCount }}</h2>
                <a href="{{ route('motorcycles.index') }}"
                   class="text-white">Manage Motorcycles</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning">
            <div class="card-body">
                <h5>Rental Packages</h5>
                <h2>{{ $packageCount }}</h2>
                <a href="{{ route('rental-packages.index') }}">Manage Packages</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h5>Rentals</h5>
                <h2>{{ $rentalCount }}</h2>
                <a href="{{ route('rentals.index') }}"
                   class="text-white">Manage Rentals</a>
            </div>
        </div>
    </div>

</div>

<div class="card mb-4">
    <div class="card-body">
        <h5>Total Paid Payments</h5>
        <h2>₱{{ number_format($paymentTotal, 2) }}</h2>
        <a href="{{ route('payments.index') }}">View Payments</a>
    </div>
</div>

<div class="card">
    <div class="card-header fw-bold">Recent Rentals</div>

    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Motorcycle</th>
                    <th>Start Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @forelse($recentRentals as $rental)
                <tr>
                    <td>{{ $rental->customer->full_name }}</td>
                    <td>{{ $rental->motorcycle->brand }}
                        {{ $rental->motorcycle->model }}</td>
                    <td>{{ $rental->start_date->format('M d, Y') }}</td>
                    <td>{{ ucfirst($rental->status) }}</td>
                    <td>
                        <a href="{{ route('rentals.show', $rental) }}"
                           class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No rentals found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection