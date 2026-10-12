@extends('layouts.app')
@section('title', 'Payments')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Payments</h2>
    <a href="{{ route('payments.create') }}" class="btn btn-primary">+ Record Payment</a>
</div>

<div class="card">
<div class="table-responsive">
<table class="table table-striped mb-0">
<thead><tr>
    <th>ID</th><th>Customer</th><th>Amount</th>
    <th>Date</th><th>Method</th><th>Status</th><th>Actions</th>
</tr></thead>
<tbody>
@forelse($payments as $payment)
<tr>
    <td>{{ $payment->id }}</td>
    <td>{{ $payment->rental->customer->full_name }}</td>
    <td>₱{{ number_format($payment->amount, 2) }}</td>
    <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
    <td>{{ ucfirst(str_replace('_', ' ', $payment->method)) }}</td>
    <td>{{ ucfirst($payment->status) }}</td>
    <td class="text-nowrap">
        <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-info">View</a>
        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning">Edit</a>
        <form method="POST" action="{{ route('payments.destroy', $payment) }}"
              class="d-inline" onsubmit="return confirm('Delete this payment?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
@empty
<tr><td colspan="7" class="text-center">No payments found.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>

<div class="mt-3">{{ $payments->links('pagination::bootstrap-5') }}</div>
@endsection