<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SerialNumberRule;

class UpdateVaccinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pet_id' => ['sometimes', 'exists:pets,id'],
            'serial_number' => ['sometimes', 'unique:vaccinations,serial_number,' . $this->route('id'), new SerialNumberRule()],
            'vaccinated_at' => ['sometimes', 'date'],
            'valid_days' => ['sometimes', 'integer', 'min:1'],
        ];
    }
}
