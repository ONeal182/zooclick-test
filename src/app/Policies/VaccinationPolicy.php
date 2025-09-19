<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vaccination;

class VaccinationPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Vaccination $vaccination): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Vaccination $vaccination): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Vaccination $vaccination): bool
    {
        return $user->role === 'admin';
    }
}
