<?php

namespace Database\Factories;

use App\Models\Vaccination;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

class VaccinationFactory extends Factory
{
    protected $model = Vaccination::class;

    public function definition(): array
    {
        return [
            'pet_id' => Pet::factory(),
            'serial_number' => strtoupper($this->faker->bothify('??#####??')),
            'vaccinated_at' => now(),
            'valid_days' => 10,
            'country' => null,
        ];
    }
}
