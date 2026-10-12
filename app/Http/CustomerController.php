<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.form', ['customer' => new Customer()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'license_number' => 'required|string|unique:customers,license_number',
        ]);

        $customer = Customer::create($data);

        return redirect()->route('customers.index')
            ->with('success', 'Customer added successfully.');
    }

    public function show(Customer $customer)
    {
        $customer->load('rentals.motorcycle', 'rentals.rentalPackage');
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.form', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required', 'email',
                Rule::unique('customers', 'email')->ignore($customer->id)
            ],
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'license_number' => [
                'required', 'string',
                Rule::unique('customers', 'license_number')->ignore($customer->id)
            ],
        ]);

        $customer->update($data);

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->rentals()->exists()) {
            return back()->with('error', 'Customer has rental records and cannot be deleted.');
        }

        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}