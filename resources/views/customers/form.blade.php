@extends('layouts.app')
@section('title', $customer->exists ? 'Edit Customer' : 'Add Customer')

@section('content')
<h2>{{ $customer->exists ? 'Edit Customer' : 'Add Customer' }}</h2>

<form method="POST"
      action="{{ $customer->exists ? route('customers.update', $customer) : route('customers.store') }}"
      class="card card-body mt-3">
    @csrf
    @if($customer->exists) @method('PUT') @endif

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">First Name</label>
            <input name="first_name" class="form-control" required
                   value="{{ old('first_name', $customer->first_name) }}">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Last Name</label>
            <input name="last_name" class="form-control" required
                   value="{{ old('last_name', $customer->last_name) }}">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required
                   value="{{ old('email', $customer->email) }}">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Phone</label>
            <input name="phone" class="form-control" required
                   value="{{ old('phone', $customer->phone) }}">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Address</label>
            <input name="address" class="form-control" required
                   value="{{ old('address', $customer->address) }}">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">License Number</label>
            <input name="license_number" class="form-control" required
                   value="{{ old('license_number', $customer->license_number) }}">
        </div>
    </div>

    <div>
        <button class="btn btn-success">Save Customer</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection