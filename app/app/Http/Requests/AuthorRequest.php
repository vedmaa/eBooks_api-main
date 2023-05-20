<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'surname' => 'required|max:50|alpha',
            'name' => 'required|max:50|alpha',
            'patronymic' => 'nullable|max:50|alpha',
            'information' => 'nullable|max:200',
        ];
    }
}
