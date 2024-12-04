<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Feedback;
use Illuminate\Contracts\Validation\Rule;

class ParentIdRule implements Rule
{
    public function passes($attribute, $value)
    {
        $check_parent = Feedback::where('id', $value);
        return !empty($check_parent);
    }

    public function message()
    {
        return 'Тікай';
    }
}
