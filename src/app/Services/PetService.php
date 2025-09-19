<?php

namespace App\Services;

use App\Models\Pet;

class PetService
{
    public function list(array $filters = [])
    {
        $query = Pet::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        return $query->paginate(10);
    }

    public function show(int $id): Pet
    {
        return Pet::findOrFail($id);
    }

    public function create(array $data): Pet
    {
        return Pet::create($data);
    }

    public function update(Pet $pet, array $data): Pet
    {
        $pet->update($data);
        return $pet;
    }

    public function delete(Pet $pet): void
    {
        $pet->delete();
    }
}
