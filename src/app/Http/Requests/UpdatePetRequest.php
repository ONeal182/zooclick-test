<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // доступ контролируется Policy
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)
        );
    }
    

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string'],
            'type' => ['sometimes', 'required', 'string'],
        ];
    }
}
