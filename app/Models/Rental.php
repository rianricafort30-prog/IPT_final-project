<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'motorcycle_id',
        'rental_package_id',
        'start_date',
        'end_date',
        'total_amount',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class);
    }

    public function rentalPackage()
    {
        return $this->belongsTo(RentalPackage::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}