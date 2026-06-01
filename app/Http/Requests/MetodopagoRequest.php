<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetodopagoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'      => 'required|string|max:255|unique:metodopagos,nombre,' . $this->metodopago,
            'descripcion' => 'nullable|string',
            'estado'      => 'required|in:1,0',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'   => 'El nombre del método de pago es obligatorio.',
            'nombre.unique'     => 'Este método de pago ya está registrado.',
            'estado.required'   => 'El estado es obligatorio.',
        ];
    }
}