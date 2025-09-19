<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\SerialNumberRule;

class UpdateVaccinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // доступ контролируется через Policy
    }

    public function rules(): array
    {
        return [
            'pet_id' => ['sometimes', 'exists:pets,id'],
            'serial_number' => [
                'sometimes',
                'string',
                Rule::unique('vaccinations', 'serial_number')->ignore($this->vaccination),
                new SerialNumberRule(),
            ],
            'vaccinated_at' => ['sometimes', 'date'],
            'valid_days' => ['sometimes', 'integer', 'min:1'],
        ];
    }
}
