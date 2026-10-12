<?php

namespace App\Http\Controllers;

use App\Models\RentalPackage;
use Illuminate\Http\Request;

class RentalPackageController extends Controller
{
    public function index()
    {
        $rentalPackages = RentalPackage::latest()->paginate(10);
        return view('rental-packages.index', compact('rentalPackages'));
    }

    public function create()
    {
        return view('rental-packages.form', [
            'rentalPackage' => new RentalPackage()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1|max:365',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'required|boolean',
        ]);

        RentalPackage::create($data);

        return redirect()->route('rental-packages.index')
            ->with('success', 'Package added successfully.');
    }

    public function show(RentalPackage $rental_package)
    {
        $rental_package->load('rentals.customer', 'rentals.motorcycle');

        return view('rental-packages.show', [
            'rentalPackage' => $rental_package
        ]);
    }

    public function edit(RentalPackage $rental_package)
    {
        return view('rental-packages.form', [
            'rentalPackage' => $rental_package
        ]);
    }

    public function update(Request $request, RentalPackage $rental_package)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1|max:365',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'required|boolean',
        ]);

        $rental_package->update($data);

        return redirect()->route('rental-packages.index')
            ->with('success', 'Package updated successfully.');
    }

    public function destroy(RentalPackage $rental_package)
    {
        if ($rental_package->rentals()->exists()) {
            return back()->with('error', 'Package is used by rental records and cannot be deleted.');
        }

        $rental_package->delete();

        return redirect()->route('rental-packages.index')
            ->with('success', 'Package deleted successfully.');
    }
}