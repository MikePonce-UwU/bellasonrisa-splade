<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email', 'unique:users,email'],
            'cedula' => ['required', 'string', 'unique:users,cedula'],
            'fecha_nacimiento' => ['required', 'date',],
            'sexo' => ['required', 'in:m,f',],
            'password' => ['required', 'min:3', 'confirmed'],
            'password_confirmation' => ['required', 'min:3'],
        ];
    }
}
