@extends('layouts.app')
@section('title', 'Payment Form')

@section('content')
<h2>{{ $payment->exists ? 'Edit Payment' : 'Record Payment' }}</h2>

<form method="POST"
      action="{{ $payment->exists ? route('payments.update', $payment) : route('payments.store') }}"
      class="card card-body mt-3">
    @csrf
    @if($payment->exists) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Rental</label>
        <select name="rental_id" class="form-select" required>
            <option value="">Choose rental</option>
            @foreach($rentals as $rentalOption)
                <option value="{{ $rentalOption->id }}"
                    @selected((string)old('rental_id', $payment->rental_id) === (string)$rentalOption->id)>
                    #{{ $rentalOption->id }} — {{ $rentalOption->customer->full_name }}
                    — ₱{{ number_format($rentalOption->total_amount, 2) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Amount (₱)</label>
        <input type="number" min="0.01" step="0.01" name="amount"
               class="form-control" required value="{{ old('amount', $payment->amount) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Payment Date</label>
        <input type="date" name="payment_date" class="form-control" required
               value="{{ old('payment_date', $payment->payment_date?->format('Y-m-d') ?? date('Y-m-d')) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Method</label>
        <select name="method" class="form-select" required>
            @foreach(['cash','gcash','bank_transfer','card'] as $method)
                <option value="{{ $method }}"
                    @selected(old('method', $payment->method ?? 'cash') === $method)>
                    {{ ucfirst(str_replace('_', ' ', $method)) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Reference Number (optional)</label>
        <input name="reference_number" class="form-control"
               value="{{ old('reference_number', $payment->reference_number) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            @foreach(['pending','paid','failed','refunded'] as $status)
                <option value="{{ $status }}"
                    @selected(old('status', $payment->status ?? 'pending') === $status)>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <button class="btn btn-success">Save Payment</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection