<?php

namespace App\Http\Requests\Api\Register;

use App\Http\Requests\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class ResendEmailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
        ];
    }
}
