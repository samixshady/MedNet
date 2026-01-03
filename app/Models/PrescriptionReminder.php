<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'reminder_note',
        'reminder_date',
        'is_sent',
    ];

    protected $casts = [
        'reminder_date' => 'datetime',
        'is_sent' => 'boolean',
    ];

    /**
     * Get the prescription that owns this reminder.
     */
    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }

    /**
     * Scope to get unsent reminders.
     */
    public function scopeUnsent($query)
    {
        return $query->where('is_sent', false);
    }

    /**
     * Scope to get due reminders.
     */
    public function scopeDue($query)
    {
        return $query->where('reminder_date', '<=', now());
    }
}
