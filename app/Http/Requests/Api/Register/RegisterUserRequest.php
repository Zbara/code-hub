<?php

namespace App\Http\Requests\Api\Register;

use App\Http\Requests\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:64'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'max:64'],
        ];
    }
}
