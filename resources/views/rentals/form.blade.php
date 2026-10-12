@extends('layouts.app')
@section('title', 'Rental Form')

@section('content')
<h2>{{ $rental->exists ? 'Edit Rental' : 'Create Rental' }}</h2>

<form method="POST"
      action="{{ $rental->exists ? route('rentals.update', $rental) : route('rentals.store') }}"
      class="card card-body mt-3">
    @csrf
    @if($rental->exists) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Customer</label>
        <select name="customer_id" class="form-select" required>
            <option value="">Choose customer</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}"
                    @selected((string)old('customer_id', $rental->customer_id) === (string)$customer->id)>
                    {{ $customer->full_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Motorcycle</label>
        <select name="motorcycle_id" class="form-select" required>
            <option value="">Choose motorcycle</option>
            @foreach($motorcycles as $motorcycle)
                <option value="{{ $motorcycle->id }}"
                    @selected((string)old('motorcycle_id', $rental->motorcycle_id) === (string)$motorcycle->id)>
                    {{ $motorcycle->brand }} {{ $motorcycle->model }}
                    — {{ $motorcycle->plate_number }}
                    ({{ ucfirst($motorcycle->status) }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Rental Package</label>
        <select name="rental_package_id" class="form-select" required>
            <option value="">Choose package</option>
            @foreach($rentalPackages as $package)
                <option value="{{ $package->id }}"
                    @selected((string)old('rental_package_id', $rental->rental_package_id) === (string)$package->id)>
                    {{ $package->name }} — ₱{{ number_format($package->price, 2) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" required
                   value="{{ old('start_date', $rental->start_date?->format('Y-m-d')) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" required
                   value="{{ old('end_date', $rental->end_date?->format('Y-m-d')) }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Total Amount (₱)</label>
        <input type="number" min="0" step="0.01" name="total_amount"
               class="form-control" required
               value="{{ old('total_amount', $rental->total_amount) }}">
        <small class="text-secondary">Enter the agreed rental amount.</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            @foreach(['pending','active','completed','cancelled'] as $status)
                <option value="{{ $status }}"
                    @selected(old('status', $rental->status ?? 'pending') === $status)>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control">{{ old('notes', $rental->notes) }}</textarea>
    </div>

    <div>
        <button class="btn btn-success">Save Rental</button>
        <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection