<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $image
 * @property mixed $file
 */
class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'year_of_issue' => 'required|max_digits:4|numeric|starts_with:1,2',
            'image' => 'sometimes|nullable|image|mimes:jpg,png,jpeg,gif',
            'file' => 'sometimes|nullable|file|mimes:epub,fb2',
            'rating' => 'sometimes|nullable',
            'price' => 'nullable|double|min:0',
        ];
    }
}
