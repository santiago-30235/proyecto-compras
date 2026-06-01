<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdencompraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'proveedor_id'   => 'required|exists:proveedores,id',
            'fecha'          => 'required|date',
            'total'          => 'required|numeric|min:0',
            'tipopago'       => 'required|string|max:50',
            'saldopendiente' => 'nullable|numeric|min:0',
            'estado'         => 'required|in:1,0',
        ];
    }

    public function messages(): array
    {
        return [
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists'   => 'El proveedor seleccionado no existe.',
            'fecha.required'        => 'La fecha es obligatoria.',
            'fecha.date'            => 'Ingrese una fecha válida.',
            'total.required'        => 'El total es obligatorio.',
            'total.numeric'         => 'El total debe ser numérico.',
            'tipopago.required'     => 'El tipo de pago es obligatorio.',
            'estado.required'       => 'El estado es obligatorio.',
        ];
    }
}