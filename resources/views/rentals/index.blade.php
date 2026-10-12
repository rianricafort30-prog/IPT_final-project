@extends('layouts.app')
@section('title', 'Rentals')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Rentals</h2>
    <a href="{{ route('rentals.create') }}" class="btn btn-primary">+ New Rental</a>
</div>

<div class="card">
<div class="table-responsive">
<table class="table table-striped mb-0">
<thead><tr>
    <th>Customer</th><th>Motorcycle</th><th>Package</th>
    <th>Start</th><th>End</th><th>Total</th><th>Status</th><th>Actions</th>
</tr></thead>
<tbody>
@forelse($rentals as $rental)
<tr>
    <td>{{ $rental->customer->full_name }}</td>
    <td>{{ $rental->motorcycle->brand }} {{ $rental->motorcycle->model }}</td>
    <td>{{ $rental->rentalPackage->name }}</td>
    <td>{{ $rental->start_date->format('Y-m-d') }}</td>
    <td>{{ $rental->end_date->format('Y-m-d') }}</td>
    <td>₱{{ number_format($rental->total_amount, 2) }}</td>
    <td>{{ ucfirst($rental->status) }}</td>
    <td class="text-nowrap">
        <a href="{{ route('rentals.show', $rental) }}" class="btn btn-sm btn-info">View</a>
        <a href="{{ route('rentals.edit', $rental) }}" class="btn btn-sm btn-warning">Edit</a>
        <form method="POST" action="{{ route('rentals.destroy', $rental) }}"
              class="d-inline" onsubmit="return confirm('Delete this rental?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
@empty
<tr><td colspan="8" class="text-center">No rentals found.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>

<div class="mt-3">{{ $rentals->links('pagination::bootstrap-5') }}</div>
@endsection