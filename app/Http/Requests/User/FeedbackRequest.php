<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FeedbackRule;
use App\Rules\ParentIdRule;

class FeedbackRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content'=> ['required', 'string', 'max:1000', new FeedbackRule],
            'parent_id'=> ['nullable', new ParentIdRule]
        ];
    }
}
