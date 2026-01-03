<?php

namespace App\Policies;

use App\Models\Prescription;
use App\Models\User;

class PrescriptionPolicy
{
    /**
     * Determine whether the user can view the prescription.
     */
    public function view(User $user, Prescription $prescription): bool
    {
        return $user->id === $prescription->user_id;
    }

    /**
     * Determine whether the user can update the prescription.
     */
    public function update(User $user, Prescription $prescription): bool
    {
        return $user->id === $prescription->user_id;
    }

    /**
     * Determine whether the user can delete the prescription.
     */
    public function delete(User $user, Prescription $prescription): bool
    {
        return $user->id === $prescription->user_id;
    }
}
