<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'generic_name',
        'description',
        'quantity',
        'expiry_date',
        'dosage',
        'tag',
        'price',
        'discount',
        'updated_price',
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
        'updated_price' => 'decimal:2',
        'discount' => 'decimal:2',
    ];
}
