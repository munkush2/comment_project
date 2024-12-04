<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;

class FeedbackRule implements Rule
{
    public function passes($attribute, $value)
    {
        if ($value == strip_tags($value)) {
            return true;
        }
        
    }

    public function message()
    {
        return 'Тікай';
    }
}
