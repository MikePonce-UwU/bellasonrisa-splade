<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDetailRequest extends FormRequest
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
            'salario' => ['required', 'numeric',],
            'adelantos' => ['required', 'numeric'],
            'hora_entrada' => 'required',
            'hora_salida' => 'required',
            'dias_laborales' => ['required', 'array', 'min:3'],
            'materias' => ['required', 'array', 'min:1'],
        ];
    }
}
