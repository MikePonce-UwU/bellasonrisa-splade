<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTutorRequest extends FormRequest
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
            'nombre_completo' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email', 'unique:tutors,email'],
            'password' => ['required', 'min:3', 'confirmed'],
            'password_confirmation' => ['required', 'min:3'],
            'sexo' => ['required', 'in:m,f'],
        ];
    }
}
