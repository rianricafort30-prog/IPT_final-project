@extends('layouts.app')
@section('title', 'Payment Details')

@section('content')
<div class="card">
    <div class="card-header"><h3>Payment Details #{{ $payment->id }}</h3></div>
    <div class="card-body">
        <p><strong>Customer:</strong> {{ $payment->rental->customer->full_name }}</p>
        <p><strong>Rental:</strong> #{{ $payment->rental_id }}</p>
        <p><strong>Amount:</strong> ₱{{ number_format($payment->amount, 2) }}</p>
        <p><strong>Date:</strong> {{ $payment->payment_date->format('Y-m-d') }}</p>
        <p><strong>Method:</strong> {{ ucfirst(str_replace('_', ' ', $payment->method)) }}</p>
        <p><strong>Reference:</strong> {{ $payment->reference_number ?: 'None' }}</p>
        <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>

        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection