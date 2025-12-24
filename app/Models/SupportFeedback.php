<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportFeedback extends Model
{
    protected $table = 'support_feedback';

    protected $fillable = [
        'name',
        'phone',
        'message',
        'status',
        'is_pinned',
        'is_urgent',
        'resolved_at',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'is_urgent' => 'boolean',
        'resolved_at' => 'datetime',
    ];
}
