<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        $pets = [
            ['name' => 'Buddy', 'type' => 'dog'],
            ['name' => 'Mittens', 'type' => 'cat'],
            ['name' => 'Charlie', 'type' => 'parrot'],
        ];

        foreach ($pets as $pet) {
            Pet::create($pet);
        }
    }
}

