<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'        => 'required|string|max:100|unique:productos,nombre,' . $this->producto,
            'precio_compra' => 'required|numeric|min:0',
            'stockmaximo'   => 'required|integer|min:0',
            'descripcion'   => 'nullable|string|max:255',
            'imagen'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Este producto ya está registrado.',
            'precio_compra.required' => 'El precio es obligatorio.',
            'precio_compra.numeric' => 'El precio debe ser numérico.',
            'stockmaximo.required' => 'El stock es obligatorio.',
            'stockmaximo.integer' => 'El stock debe ser entero.',
            'imagen.image' => 'El archivo debe ser imagen.',
            'imagen.mimes' => 'Formato permitido: jpg, jpeg, png, webp.',
            'imagen.max' => 'La imagen no puede superar 2MB.',
        ];
    }
}