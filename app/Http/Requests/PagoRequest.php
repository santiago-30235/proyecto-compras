<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ordencompra_id' => 'required|exists:ordencompras,id',
            'metodopago_id'  => 'required|exists:metodopagos,id',
            'fechapago'      => 'required|date',
            'monto'          => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'ordencompra_id.required' => 'Debe seleccionar una orden de compra.',
            'ordencompra_id.exists'   => 'La orden de compra no existe.',
            'metodopago_id.required'  => 'Debe seleccionar un método de pago.',
            'metodopago_id.exists'    => 'El método de pago no existe.',
            'fechapago.required'      => 'La fecha de pago es obligatoria.',
            'fechapago.date'          => 'Ingrese una fecha válida.',
            'monto.required'          => 'El monto es obligatorio.',
            'monto.numeric'           => 'El monto debe ser numérico.',
        ];
    }
}