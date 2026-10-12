<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('rental.customer')
            ->latest()->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        return view('payments.form', [
            'payment' => new Payment(),
            'rentals' => Rental::with('customer')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'method' => [
                'required',
                Rule::in(['cash', 'gcash', 'bank_transfer', 'card'])
            ],
            'reference_number' => 'nullable|string|max:255',
            'status' => [
                'required',
                Rule::in(['pending', 'paid', 'failed', 'refunded'])
            ],
        ]);

        Payment::create($data);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load('rental.customer', 'rental.motorcycle');
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.form', [
            'payment' => $payment,
            'rentals' => Rental::with('customer')->latest()->get(),
        ]);
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'rental_id' => 'required|exists:rentals,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'method' => [
                'required',
                Rule::in(['cash', 'gcash', 'bank_transfer', 'card'])
            ],
            'reference_number' => 'nullable|string|max:255',
            'status' => [
                'required',
                Rule::in(['pending', 'paid', 'failed', 'refunded'])
            ],
        ]);

        $payment->update($data);

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}