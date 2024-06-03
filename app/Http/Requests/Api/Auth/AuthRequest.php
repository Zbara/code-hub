<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\FormRequest;

class AuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:254', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
