<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ModeratorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|max:50|unique:moderators',
            'password' => ['required', 'max:25', Password::min(8)->mixedCase()->numbers()],
        ];
    }
}
