<?php

namespace Database\Seeders;

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
            ['name' => 'Max', 'type' => 'dog'],
            ['name' => 'Luna', 'type' => 'cat'],
            ['name' => 'Rocky', 'type' => 'dog'],
            ['name' => 'Bella', 'type' => 'dog'],
            ['name' => 'Coco', 'type' => 'parrot'],
            ['name' => 'Daisy', 'type' => 'cat'],
            ['name' => 'Milo', 'type' => 'dog'],
            ['name' => 'Oliver', 'type' => 'cat'],
            ['name' => 'Simba', 'type' => 'cat'],
            ['name' => 'Nala', 'type' => 'cat'],
            ['name' => 'Chloe', 'type' => 'dog'],
            ['name' => 'Oscar', 'type' => 'dog'],
            ['name' => 'Ruby', 'type' => 'parrot'],
            ['name' => 'Leo', 'type' => 'dog'],
            ['name' => 'Lucy', 'type' => 'cat'],
            ['name' => 'Jack', 'type' => 'dog'],
            ['name' => 'Lola', 'type' => 'cat'],
        ];

        foreach ($pets as $pet) {
            Pet::create($pet);
        }
    }
}
