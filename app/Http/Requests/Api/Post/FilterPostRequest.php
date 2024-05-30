<?php

namespace App\Http\Requests\Api\Post;

use App\Http\Requests\FormRequest;

class FilterPostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'created_at' => ['nullable', 'date_format:Y-m-d'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
