<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'numero_factura' => ['required', 'unique:invoices,numero_factura', 'min:5',],
            'razon' => ['required', 'min:5', 'string'],
            'descripcion_factura' => ['required', 'min:5', 'string'],
            'total_factura' => ['required', 'numeric'],
            'income' => ['required', 'boolean']
        ];
    }
}
