
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Motorcycle Rental System Dashboard</h2>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card bg-primary text-white p-3">
                <h5>Total Customers</h5>
                <h2>{{ $customerCount }}</h2>
                <a href="{{ route('customers.index') }}" class="text-white">
                    View Customers
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white p-3">
                <h5>Total Motorcycles</h5>
                <h2>{{ $motorcycleCount }}</h2>
                <a href="{{ route('motorcycles.index') }}" class="text-white">
                    View Motorcycles
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info text-white p-3">
                <h5>Rental Packages</h5>
                <h2>{{ $packageCount }}</h2>
                <a href="{{ route('rental-packages.index') }}" class="text-white">
                    View Packages
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-warning p-3">
                <h5>Total Rentals</h5>
                <h2>{{ $rentalCount }}</h2>
                <a href="{{ route('rentals.index') }}" class="text-dark">
                    View Rentals
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-dark text-white p-3">
                <h5>Total Payments Received</h5>
                <h2>₱{{ number_format($paymentTotal, 2) }}</h2>
                <a href="{{ route('payments.index') }}" class="text-white">
                    View Payments
                </a>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Recent Rentals</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Motorcycle</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentRentals as $rental)
                        <tr>
                            <td>{{ $rental->customer->full_name }}</td>
                            <td>
                                {{ $rental->motorcycle->brand }}
                                {{ $rental->motorcycle->model }}
                            </td>
                            <td>{{ $rental->start_date->format('Y-m-d') }}</td>
                            <td>{{ $rental->end_date->format('Y-m-d') }}</td>
                            <td>{{ ucfirst($rental->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No rentals available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
