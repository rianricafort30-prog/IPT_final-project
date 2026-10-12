@extends('layouts.app')
@section('title', 'Motorcycles')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Motorcycles</h2>
    <a href="{{ route('motorcycles.create') }}" class="btn btn-primary">+ Add Motorcycle</a>
</div>

<div class="card">
<div class="table-responsive">
<table class="table table-striped mb-0">
<thead><tr>
    <th>Brand / Model</th><th>Plate</th><th>Year</th>
    <th>Daily Rate</th><th>Status</th><th>Actions</th>
</tr></thead>
<tbody>
@forelse($motorcycles as $motorcycle)
<tr>
    <td>{{ $motorcycle->brand }} {{ $motorcycle->model }}</td>
    <td>{{ $motorcycle->plate_number }}</td>
    <td>{{ $motorcycle->year }}</td>
    <td>₱{{ number_format($motorcycle->daily_rate, 2) }}</td>
    <td>{{ ucfirst($motorcycle->status) }}</td>
    <td class="text-nowrap">
        <a href="{{ route('motorcycles.show', $motorcycle) }}" class="btn btn-sm btn-info">View</a>
        <a href="{{ route('motorcycles.edit', $motorcycle) }}" class="btn btn-sm btn-warning">Edit</a>
        <form method="POST" action="{{ route('motorcycles.destroy', $motorcycle) }}"
              class="d-inline" onsubmit="return confirm('Delete this motorcycle?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
@empty
<tr><td colspan="6" class="text-center">No motorcycles found.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>

<div class="mt-3">{{ $motorcycles->links('pagination::bootstrap-5') }}</div>
@endsection