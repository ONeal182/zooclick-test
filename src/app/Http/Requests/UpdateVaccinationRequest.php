<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SerialNumberRule;

class UpdateVaccinationRequest extends FormRequest
{
    protected $redirect = null;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pet_id' => ['sometimes', 'required', 'exists:pets,id'],
            'serial_number' => ['sometimes', 'required', 'string', 'unique:vaccinations,serial_number,' . $this->vaccination->id, new SerialNumberRule()],
            'vaccinated_at' => ['sometimes', 'required', 'date'],
            'valid_days' => ['sometimes', 'required', 'integer', 'min:1'],
        ];
    }
}
