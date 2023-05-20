<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookshelfRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_id' => 'required|integer|exists:books,id',
            'shelf_id' => 'required|integer|exists:shelves,id',
        ];
    }
}
