@extends('layouts.app')
@section('title', 'Motorcycle Form')

@section('content')
<h2>{{ $motorcycle->exists ? 'Edit Motorcycle' : 'Add Motorcycle' }}</h2>

<form method="POST"
      action="{{ $motorcycle->exists ? route('motorcycles.update', $motorcycle) : route('motorcycles.store') }}"
      class="card card-body mt-3">
    @csrf
    @if($motorcycle->exists) @method('PUT') @endif

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Brand</label>
            <input name="brand" class="form-control" required value="{{ old('brand', $motorcycle->brand) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Model</label>
            <input name="model" class="form-control" required value="{{ old('model', $motorcycle->model) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Plate Number</label>
            <input name="plate_number" class="form-control" required value="{{ old('plate_number', $motorcycle->plate_number) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" required value="{{ old('year', $motorcycle->year ?? date('Y')) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Daily Rate (₱)</label>
            <input type="number" step="0.01" min="0" name="daily_rate" class="form-control" required value="{{ old('daily_rate', $motorcycle->daily_rate) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                @foreach(['available','rented','maintenance'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $motorcycle->status ?? 'available') === $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $motorcycle->description) }}</textarea>
        </div>
    </div>

    <div>
        <button class="btn btn-success">Save Motorcycle</button>
        <a href="{{ route('motorcycles.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection