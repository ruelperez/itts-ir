<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class Base64Image implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Ensure it's a base64 encoded image
        return preg_match('/^data:image\/(\w+);base64,/', $value);
    }

    public function message()
    {
        return 'The signature must be a valid image.';
    }
}

