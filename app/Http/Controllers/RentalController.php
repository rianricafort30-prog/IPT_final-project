<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Motorcycle;
use App\Models\Rental;
use App\Models\RentalPackage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RentalController extends Controller
{
    private function formData()
    {
        return [
            'customers' => Customer::orderBy('first_name')->get(),
            'motorcycles' => Motorcycle::orderBy('brand')->get(),
            'rentalPackages' => RentalPackage::where('is_active', true)->get(),
        ];
    }

    public function index()
    {
        $rentals = Rental::with([
            'customer', 'motorcycle', 'rentalPackage'
        ])->latest()->paginate(10);

        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        return view('rentals.form', array_merge(
            $this->formData(),
            ['rental' => new Rental()]
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'motorcycle_id' => 'required|exists:motorcycles,id',
            'rental_package_id' => 'required|exists:rental_packages,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_amount' => 'required|numeric|min:0',
            'status' => [
                'required',
                Rule::in(['pending', 'active', 'completed', 'cancelled'])
            ],
            'notes' => 'nullable|string|max:1000',
        ]);

        $rental = Rental::create($data);

        if ($rental->status === 'active') {
            $rental->motorcycle->update(['status' => 'rented']);
        }

        return redirect()->route('rentals.index')
            ->with('success', 'Rental created successfully.');
    }

    public function show(Rental $rental)
    {
        $rental->load([
            'customer', 'motorcycle', 'rentalPackage', 'payments'
        ]);

        return view('rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        return view('rentals.form', array_merge(
            $this->formData(),
            compact('rental')
        ));
    }

    public function update(Request $request, Rental $rental)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'motorcycle_id' => 'required|exists:motorcycles,id',
            'rental_package_id' => 'required|exists:rental_packages,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_amount' => 'required|numeric|min:0',
            'status' => [
                'required',
                Rule::in(['pending', 'active', 'completed', 'cancelled'])
            ],
            'notes' => 'nullable|string|max:1000',
        ]);

        $oldMotorcycle = $rental->motorcycle;

        $rental->update($data);

        if (
            $oldMotorcycle &&
            $oldMotorcycle->id != $data['motorcycle_id'] &&
            $oldMotorcycle->status === 'rented'
        ) {
            $oldMotorcycle->update(['status' => 'available']);
        }

        $rental->refresh();

        if ($rental->status === 'active') {
            $rental->motorcycle->update(['status' => 'rented']);
        } elseif (in_array($rental->status, ['completed', 'cancelled'])) {
            if ($rental->motorcycle->status === 'rented') {
                $rental->motorcycle->update(['status' => 'available']);
            }
        }

        return redirect()->route('rentals.index')
            ->with('success', 'Rental updated successfully.');
    }

    public function destroy(Rental $rental)
    {
        if ($rental->payments()->exists()) {
            return back()->with('error', 'Delete the rental payments first.');
        }

        $motorcycle = $rental->motorcycle;
        $rental->delete();

        if ($motorcycle && $motorcycle->status === 'rented') {
            $motorcycle->update(['status' => 'available']);
        }

        return redirect()->route('rentals.index')
            ->with('success', 'Rental deleted successfully.');
    }
}