<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Closure;

class Uppercase implements Rule
{
    
    
    public function passes($attribute, $value)
    {
        return strtoupper($value) === $value;
    }

    
    
    public function message()
    {
        return 'La obra_social debe estar en MAYÚSCULAS.';
    }
}
