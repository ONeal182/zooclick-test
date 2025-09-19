<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;

class PetPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Pet $pet): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Pet $pet): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Pet $pet): bool
    {
        return $user->role === 'admin';
    }
}
