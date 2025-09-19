<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SerialNumberRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $patterns = [
            '/^[A-Z0-9]{2}[A-Z]{5}[A-Z0-9][A-Z]{2}$/',
            '/^[0-9][A-Z0-9]{2}[A-Z]{2}[-_@][A-Z]{2}[a-z]{2}$/',
            '/^[0-9][A-Z]{4}[-_@][A-Z][A-Z0-9]{3}$/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return; // совпало — валидный серийный номер
            }
        }

        $fail("The {$attribute} format is invalid.");
    }
}
