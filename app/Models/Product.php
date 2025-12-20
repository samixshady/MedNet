<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'expiry_date',
        'dosage',
        'tag',
        'price',
        'prescription_required',
        'manufacturer',
        'side_effects',
        'low_stock_threshold',
        'image_path',
        'stock_status',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'prescription_required' => 'boolean',
        'price' => 'decimal:2',
    ];
}
