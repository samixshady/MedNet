<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannedEmail extends Model
{
    protected $table = 'banned_emails';

    protected $fillable = [
        'email',
        'reason',
        'banned_at',
    ];

    protected function casts(): array
    {
        return [
            'banned_at' => 'datetime',
        ];
    }
}
