<?php

namespace App\Http\Requests\Api\Post;

use App\Http\Requests\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
