@extends('layouts.app')
@section('title', 'Customer Details')

@section('content')
<div class="card">
    <div class="card-header"><h3>Customer Details</h3></div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $customer->full_name }}</p>
        <p><strong>Email:</strong> {{ $customer->email }}</p>
        <p><strong>Phone:</strong> {{ $customer->phone }}</p>
        <p><strong>Address:</strong> {{ $customer->address }}</p>
        <p><strong>License:</strong> {{ $customer->license_number }}</p>

        <a href="{{ route('customers.edit', $customer) }}"
           class="btn btn-warning">Edit</a>
        <a href="{{ route('customers.index') }}"
           class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">Customer Rental History</div>
    <div class="card-body">
        @forelse($customer->rentals as $rental)
            <p>
                {{ $rental->motorcycle->brand }}
                {{ $rental->motorcycle->model }}
                — {{ $rental->status }}
            </p>
        @empty
            <p>No rental history.</p>
        @endforelse
    </div>
</div>
@endsection