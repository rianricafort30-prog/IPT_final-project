@extends('layouts.app')
@section('title', 'Package Details')

@section('content')
<div class="card">
    <div class="card-header"><h3>Package Details</h3></div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $rentalPackage->name }}</p>
        <p><strong>Duration:</strong> {{ $rentalPackage->duration_days }} day(s)</p>
        <p><strong>Price:</strong> ₱{{ number_format($rentalPackage->price, 2) }}</p>
        <p><strong>Description:</strong> {{ $rentalPackage->description ?: 'None' }}</p>
        <p><strong>Active:</strong> {{ $rentalPackage->is_active ? 'Yes' : 'No' }}</p>
        <a href="{{ route('rental-packages.edit', $rentalPackage) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('rental-packages.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection