<?php

namespace App\Presentation\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', 'min:3', 'max:255'],
            'content' => ['required', 'string', 'min:3'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
