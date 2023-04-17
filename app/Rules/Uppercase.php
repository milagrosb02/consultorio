<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Closure;

class Uppercase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return strtoupper($value) === $value;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strtoupper($value) !== $value) {
            $fail('The :attribute must be uppercase.');
        }

        // agregue estos IF para las validaciones
        if (strtoupper($value) !== $value) {
            $fail('validation.uppercase')->translate();
        }

        
        // $fail('validation.location')->translate([
        //     'value' => $this->value,
        // ], 'es');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo debe estar en MAYÚSCULAS.';
    }
}
