<?php

namespace App\Presentation\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class IndexPostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'authorId' => ['nullable', 'int', 'min:1', 'max:4096'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
