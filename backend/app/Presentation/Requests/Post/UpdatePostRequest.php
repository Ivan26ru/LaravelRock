<?php

namespace App\Presentation\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'   => ['required', 'min:3', 'max:255'],
            'content' => ['nullable', 'min:3'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
