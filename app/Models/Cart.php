<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'prescription_file',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSubtotalAttribute()
    {
        $price = $this->product->updated_price ?? $this->product->price;
        return $price * $this->quantity;
    }
}
