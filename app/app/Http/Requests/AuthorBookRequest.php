<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author_id' => 'required|integer|exists:authors,id',
            'book_id' => 'required|integer|exists:books,id',
        ];
    }
}
