<?php

namespace App\Services;

use App\Models\Vaccination;
use Illuminate\Support\Facades\Http;

class VaccinationService
{
    public function list(array $filters = [])
    {
        $query = Vaccination::query();

        if (!empty($filters['serial_number'])) {
            $query->where('serial_number', 'like', "%{$filters['serial_number']}%");
        }

        if (!empty($filters['country'])) {
            $query->where('country', $filters['country']);
        }

        return $query->paginate(10);
    }

    public function show(int $id): Vaccination
    {
        return Vaccination::findOrFail($id);
    }

    public function create(array $data): Vaccination
    {
        $vaccination = Vaccination::create($data);
        $country = $this->fetchCountry($vaccination->serial_number);
        if ($country) {
            $vaccination->update(['country' => $country]);
        }
        return $vaccination;
    }

    public function update(Vaccination $vaccination, array $data): Vaccination
    {
        $vaccination->update($data);
        return $vaccination;
    }

    public function delete(Vaccination $vaccination): void
    {
        $vaccination->delete();
    }

    private function fetchCountry(string $serial): ?string
    {
        $url = "https://f9ef4591e5c6e3f9.mokky.dev/vaccinations?uuid={$serial}";
        $response = Http::get($url);

        if ($response->successful() && !empty($response[0]['country'])) {
            return $response[0]['country'];
        }

        return null;
    }
}
