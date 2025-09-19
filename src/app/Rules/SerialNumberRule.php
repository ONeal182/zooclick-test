<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SerialNumberRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $patterns = config('serial_masks.patterns');

        foreach ($patterns as $pattern => $maskName) {
            if (preg_match($pattern, $value)) {
                return;
            }
        }

        $examples = [
            '2BHHHHA8BB',
            '5YY9D-A8ff',
            '9ZZZD-HJYU',
            '1CCDDDE9FF',
            '6QQ7E@K2gg',
            '8WWW9-YTGR',
            '3EEFFFFF1GG',
            '7TT8X-Z5hh',
            '0VVV0-XPKL',
            '4GGHHHI2JJ',
        ];

        $fail("The {$attribute} format is invalid. Example of valid values: " . implode(', ', $examples));
    }
}
