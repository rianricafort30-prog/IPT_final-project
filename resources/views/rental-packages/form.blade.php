@extends('layouts.app')
@section('title', 'Rental Package Form')

@section('content')
<h2>{{ $rentalPackage->exists ? 'Edit Package' : 'Add Package' }}</h2>

<form method="POST"
      action="{{ $rentalPackage->exists ? route('rental-packages.update', $rentalPackage) : route('rental-packages.store') }}"
      class="card card-body mt-3">
    @csrf
    @if($rentalPackage->exists) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Package Name</label>
        <input name="name" class="form-control" required value="{{ old('name', $rentalPackage->name) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Duration (days)</label>
        <input type="number" min="1" max="365" name="duration_days" class="form-control" required value="{{ old('duration_days', $rentalPackage->duration_days ?? 1) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Price (₱)</label>
        <input type="number" min="0" step="0.01" name="price" class="form-control" required value="{{ old('price', $rentalPackage->price) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ old('description', $rentalPackage->description) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Active?</label>
        <select name="is_active" class="form-select" required>
            <option value="1" @selected((string)old('is_active', $rentalPackage->exists ? (int)$rentalPackage->is_active : 1) === '1')>Yes</option>
            <option value="0" @selected((string)old('is_active', $rentalPackage->exists ? (int)$rentalPackage->is_active : 1) === '0')>No</option>
        </select>
    </div>

    <div>
        <button class="btn btn-success">Save Package</button>
        <a href="{{ route('rental-packages.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection