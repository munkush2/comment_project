<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailRule;

class Create extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => ['required', 'string', 'email', 'max:255', new EmailRule],
            'password' => 'required|string|min:6|max:255|confirmed',
            'password_confirmation' => 'required|string|min:6|max:255'
        ];

    }
}
