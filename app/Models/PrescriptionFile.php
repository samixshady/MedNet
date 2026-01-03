<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'file_path',
        'file_type',
        'original_name',
        'file_size',
    ];

    /**
     * Get the prescription that owns this file.
     */
    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }

    /**
     * Get the full URL for the file.
     */
    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Check if file is an image.
     */
    public function isImage(): bool
    {
        return in_array($this->file_type, ['jpg', 'jpeg', 'png']);
    }

    /**
     * Check if file is a PDF.
     */
    public function isPdf(): bool
    {
        return $this->file_type === 'pdf';
    }
}
