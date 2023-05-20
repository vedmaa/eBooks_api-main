<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'surname' => 'nullable|max:50|alpha',
            'name' => 'nullable|max:50|alpha',
            'patronymic' => 'nullable|max:50|alpha',
            'username' => 'nullable|max:20|alpha|unique:users',
            'email' => 'nullable|email:rfc,dns|unique:users',
            'role_id' => 'nullable|exists:roles,id',
            'wallet' => 'nullable|double',
        ];
    }
}
