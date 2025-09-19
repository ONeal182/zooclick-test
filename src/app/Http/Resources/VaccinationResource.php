<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VaccinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pet_id' => $this->pet_id,
            'serial_number' => $this->serial_number,
            'vaccinated_at' => $this->vaccinated_at,
            'valid_days' => $this->valid_days,
            'country' => $this->country,
        ];
    }
}
