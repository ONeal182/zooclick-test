<?php

namespace App\Services;

use App\Models\Vaccination;
use Illuminate\Support\Facades\Http;

class VaccinationService
{
    public function list(array $filters)
    {
        $query = Vaccination::query();

        if (!empty($filters['serial_number'])) {
            $query->where('serial_number', 'like', '%' . $filters['serial_number'] . '%');
        }

        if (!empty($filters['country'])) {
            $query->where('country', $filters['country']);
        }

        if (!empty($filters['pet_id'])) {
            $query->where('pet_id', $filters['pet_id']);
        }

        $perPage = $filters['per_page'] ?? 15;

        return $query->paginate($perPage);
    }

    public function create(array $data): Vaccination
    {
        if (!empty($data['serial_number'])) {
            $data['country'] = $this->fetchCountry($data['serial_number']);
        }

        return Vaccination::create($data);
    }

    public function update(Vaccination $vaccination, array $data): Vaccination
    {
        if (isset($data['serial_number']) && $data['serial_number'] !== $vaccination->serial_number) {
            $data['country'] = $this->fetchCountry($data['serial_number']);
        }

        $vaccination->update($data);

        return $vaccination;
    }

    public function delete(Vaccination $vaccination): void
    {
        $vaccination->delete();
    }

    private function fetchCountry(string $uuid): ?string
    {
        $url = "https://f9ef4591e5c6e3f9.mokky.dev/vaccinations?uuid={$uuid}";
        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            return $data[0]['country'] ?? null;
        }

        return null;
    }
}
