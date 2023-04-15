<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTutorRequest extends FormRequest
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
            //
            'nombre_completo' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email', 'unique:tutors,email,' . $this->request->get('id')],
            'password' => ['sometimes', 'confirmed'],
            'password_confirmation' => [],
            'sexo' => ['required', 'in:m,f'],
        ];
    }
}
