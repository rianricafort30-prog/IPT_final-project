@extends('layouts.app')
@section('title', 'Rental Packages')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Rental Packages</h2>
    <a href="{{ route('rental-packages.create') }}" class="btn btn-primary">+ Add Package</a>
</div>

<div class="card">
<div class="table-responsive">
<table class="table table-striped mb-0">
<thead><tr><th>Name</th><th>Duration</th><th>Price</th><th>Active</th><th>Actions</th></tr></thead>
<tbody>
@forelse($rentalPackages as $package)
<tr>
    <td>{{ $package->name }}</td>
    <td>{{ $package->duration_days }} day(s)</td>
    <td>₱{{ number_format($package->price, 2) }}</td>
    <td>{{ $package->is_active ? 'Yes' : 'No' }}</td>
    <td class="text-nowrap">
        <a href="{{ route('rental-packages.show', $package) }}" class="btn btn-sm btn-info">View</a>
        <a href="{{ route('rental-packages.edit', $package) }}" class="btn btn-sm btn-warning">Edit</a>
        <form method="POST" action="{{ route('rental-packages.destroy', $package) }}"
              class="d-inline" onsubmit="return confirm('Delete this package?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
@empty
<tr><td colspan="5" class="text-center">No packages found.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>

<div class="mt-3">{{ $rentalPackages->links('pagination::bootstrap-5') }}</div>
@endsection