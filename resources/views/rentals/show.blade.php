@extends('layouts.app')
@section('title', 'Rental Details')

@section('content')
<div class="card">
    <div class="card-header"><h3>Rental Details #{{ $rental->id }}</h3></div>
    <div class="card-body">
        <p><strong>Customer:</strong> {{ $rental->customer->full_name }}</p>
        <p><strong>Motorcycle:</strong> {{ $rental->motorcycle->brand }} {{ $rental->motorcycle->model }}</p>
        <p><strong>Package:</strong> {{ $rental->rentalPackage->name }}</p>
        <p><strong>Start Date:</strong> {{ $rental->start_date->format('Y-m-d') }}</p>
        <p><strong>End Date:</strong> {{ $rental->end_date->format('Y-m-d') }}</p>
        <p><strong>Total:</strong> ₱{{ number_format($rental->total_amount, 2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($rental->status) }}</p>
        <p><strong>Notes:</strong> {{ $rental->notes ?: 'None' }}</p>

        <a href="{{ route('rentals.edit', $rental) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('payments.create') }}" class="btn btn-primary">Record Payment</a>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">Payments for this rental</div>
    <div class="card-body">
        @forelse($rental->payments as $payment)
            <p>
                ₱{{ number_format($payment->amount, 2) }}
                — {{ ucfirst($payment->status) }}
                — {{ $payment->payment_date->format('Y-m-d') }}
            </p>
        @empty
            <p>No payments recorded.</p>
        @endforelse
    </div>
</div>
@endsection