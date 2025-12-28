<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'pharmacy_id',
        'name',
        'generic_name',
        'batch_number',
        'description',
        'quantity',
        'expiry_date',
        'dosage',
        'tag',
        'category',
        'price',
        'discount',
        'updated_price',
        'prescription_required',
        'requires_prescription',
        'manufacturer',
        'side_effects',
        'low_stock_threshold',
        'image_path',
        'stock_status',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'prescription_required' => 'boolean',
        'requires_prescription' => 'boolean',
        'price' => 'decimal:2',
        'updated_price' => 'decimal:2',
        'discount' => 'decimal:2',
    ];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function isFromPharmacy()
    {
        return !is_null($this->pharmacy_id);
    }
}
