<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 👈 Cambiado a true
    }

    public function rules(): array
    {
        return [
            'nombre'    => 'required|string|max:255',
            'documento' => 'required|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'telefono'  => 'required|string|max:20',
            'email'     => 'required|email|unique:proveedores,email,' . $this->proveedor,
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'documento.required' => 'El documento es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Ingrese un email válido.',
            'email.unique' => 'Este email ya está registrado.',
        ];
    }
}