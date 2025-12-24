<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'tracking_number',
        'total_amount',
        'delivery_address',
        'delivery_latitude',
        'delivery_longitude',
        'payment_method',
        'payment_status',
        'order_status',
        'notes',
        'prescription_required',
        'prescription_status',
        'prescription_rejection_reason',
        'prescription_reviewed_at',
        'prescription_reviewed_by',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'prescription_required' => 'boolean',
        'prescription_reviewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function generateTrackingNumber()
    {
        return 'MN' . strtoupper(date('Ymd')) . '-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
