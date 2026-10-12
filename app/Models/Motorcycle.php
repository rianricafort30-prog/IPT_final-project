<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'plate_number',
        'year',
        'daily_rate',
        'status',
        'description',
    ];

    protected $casts = [
        'daily_rate' => 'decimal:2',
        'year' => 'integer',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}