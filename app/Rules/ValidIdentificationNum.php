<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Tavo\ValidadorEc;

class ValidIdentificationNum implements ValidationRule
{
    
    protected $validator ;

    public function __construct() {
        $this->validator = new ValidadorEc();
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // if()
    }
}
