<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SerialNumberRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $patterns = [
            '/^[0-9][A-Z]{5}[0-9][A-Z][A-Z]$/',              // XXAAAAAXAA (примерная маска)
            '/^[0-9][A-Z]{2}[0-9][A-Z]{2}[-_@][A-Z]{2}$/',   // NXXAAXZXaa
            '/^[0-9][A-Z]{4}[-_@][A-Z]{3}$/',                // NAAAAXZXXX
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return; // Успех
            }
        }

        $fail("The {$attribute} format is invalid.");
    }
}