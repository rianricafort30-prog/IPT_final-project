<?php

namespace App\Http\Controllers;

use App\Models\Motorcycle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MotorcycleController extends Controller
{
    public function index()
    {
        $motorcycles = Motorcycle::latest()->paginate(10);
        return view('motorcycles.index', compact('motorcycles'));
    }

    public function create()
    {
        return view('motorcycles.form', ['motorcycle' => new Motorcycle()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'plate_number' => 'required|string|unique:motorcycles,plate_number',
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'daily_rate' => 'required|numeric|min:0',
            'status' => ['required', Rule::in(['available', 'rented', 'maintenance'])],
            'description' => 'nullable|string|max:1000',
        ]);

        Motorcycle::create($data);

        return redirect()->route('motorcycles.index')
            ->with('success', 'Motorcycle added successfully.');
    }

    public function show(Motorcycle $motorcycle)
    {
        $motorcycle->load('rentals.customer');
        return view('motorcycles.show', compact('motorcycle'));
    }

    public function edit(Motorcycle $motorcycle)
    {
        return view('motorcycles.form', compact('motorcycle'));
    }

    public function update(Request $request, Motorcycle $motorcycle)
    {
        $data = $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'plate_number' => [
                'required', 'string',
                Rule::unique('motorcycles', 'plate_number')->ignore($motorcycle->id)
            ],
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'daily_rate' => 'required|numeric|min:0',
            'status' => ['required', Rule::in(['available', 'rented', 'maintenance'])],
            'description' => 'nullable|string|max:1000',
        ]);

        $motorcycle->update($data);

        return redirect()->route('motorcycles.index')
            ->with('success', 'Motorcycle updated successfully.');
    }

    public function destroy(Motorcycle $motorcycle)
    {
        if ($motorcycle->rentals()->exists()) {
            return back()->with('error', 'Motorcycle has rental records and cannot be deleted.');
        }

        $motorcycle->delete();

        return redirect()->route('motorcycles.index')
            ->with('success', 'Motorcycle deleted successfully.');
    }
}