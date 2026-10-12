@extends('layouts.app')
@section('title', 'Motorcycle Details')

@section('content')
<div class="card">
    <div class="card-header"><h3>Motorcycle Details</h3></div>
    <div class="card-body">
        <p><strong>Brand:</strong> {{ $motorcycle->brand }}</p>
        <p><strong>Model:</strong> {{ $motorcycle->model }}</p>
        <p><strong>Plate:</strong> {{ $motorcycle->plate_number }}</p>
        <p><strong>Year:</strong> {{ $motorcycle->year }}</p>
        <p><strong>Daily Rate:</strong> ₱{{ number_format($motorcycle->daily_rate, 2) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($motorcycle->status) }}</p>
        <p><strong>Description:</strong> {{ $motorcycle->description ?: 'None' }}</p>
        <a href="{{ route('motorcycles.edit', $motorcycle) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('motorcycles.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection