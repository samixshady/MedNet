<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pharmacy extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'shop_name',
        'owner_name',
        'email',
        'password',
        'phone',
        'address',
        'trade_license_number',
        'trade_license_date',
        'license_expiry_date',
        'status',
        'rejection_reason',
        'approved_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'approved_at' => 'datetime',
        'trade_license_date' => 'date',
        'license_expiry_date' => 'date',
        'password' => 'hashed',
    ];

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isBanned()
    {
        return $this->status === 'banned';
    }

    public function isLicenseExpired()
    {
        if (!$this->license_expiry_date) {
            return false;
        }
        return now()->isAfter($this->license_expiry_date);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'pharmacy_id');
    }
}
