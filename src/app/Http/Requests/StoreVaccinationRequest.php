<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SerialNumberRule;

class StoreVaccinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pet_id' => ['required', 'exists:pets,id'],
            'serial_number' => ['required', 'unique:vaccinations,serial_number', new SerialNumberRule()],
            'vaccinated_at' => ['required', 'date'],
            'valid_days' => ['required', 'integer', 'min:1'],
        ];
    }
}
