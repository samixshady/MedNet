<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'notes',
        'doctor_name',
        'prescription_date',
        'next_visit_date',
        'is_archived',
    ];

    protected $casts = [
        'prescription_date' => 'date',
        'next_visit_date' => 'date',
        'is_archived' => 'boolean',
    ];

    /**
     * Get the user that owns this prescription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the prescription files.
     */
    public function files(): HasMany
    {
        return $this->hasMany(PrescriptionFile::class);
    }

    /**
     * Get the tags for this prescription.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            PrescriptionTag::class,
            'prescription_tag_pivot',
            'prescription_id',
            'prescription_tag_id'
        );
    }

    /**
     * Get the reminders for this prescription.
     */
    public function reminders(): HasMany
    {
        return $this->hasMany(PrescriptionReminder::class);
    }

    /**
     * Scope to get active prescriptions.
     */
    public function scopeActive($query)
    {
        return $query->where('is_archived', false);
    }

    /**
     * Scope to get archived prescriptions.
     */
    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }

    /**
     * Scope to get prescriptions with upcoming visits.
     */
    public function scopeUpcomingVisits($query)
    {
        return $query->whereNotNull('next_visit_date')
            ->where('next_visit_date', '>=', now())
            ->orderBy('next_visit_date');
    }

    /**
     * Check if prescription has an upcoming visit.
     */
    public function hasUpcomingVisit(): bool
    {
        return $this->next_visit_date && $this->next_visit_date->isFuture();
    }

    /**
     * Get days until next visit.
     */
    public function daysUntilVisit(): ?int
    {
        if (!$this->next_visit_date) {
            return null;
        }
        return now()->diffInDays($this->next_visit_date, false);
    }
}
