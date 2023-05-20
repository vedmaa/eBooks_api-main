<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
            'username' => 'required|max:20|unique:users',
            'email' => 'required|email:rfc,dns|unique:users',
            'role_id' => 'required|exists:roles,id',
            'wallet' => 'nullable|double',
        ];
    }
}
