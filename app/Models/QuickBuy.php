<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuickBuy extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'user_name',
        'user_email',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Get the user that owns the quick buy item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product associated with the quick buy item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
