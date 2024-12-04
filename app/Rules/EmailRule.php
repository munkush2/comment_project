<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class EmailRule implements Rule
{
    public function passes($attribute, $value)
    {
        $check_user = User::where('email', $value)->first();
        return empty($check_user);
    }

    public function message()
    {
        return 'Email уже зарегистрирован';
    }
}
