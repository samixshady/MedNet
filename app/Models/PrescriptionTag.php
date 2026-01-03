<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PrescriptionTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'color',
    ];

    /**
     * Get the user that owns this tag.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the prescriptions for this tag.
     */
    public function prescriptions(): BelongsToMany
    {
        return $this->belongsToMany(
            Prescription::class,
            'prescription_tag_pivot',
            'prescription_tag_id',
            'prescription_id'
        );
    }
}
