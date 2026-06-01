<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'ordencompra_id',
        'fechapago',
        'monto',
        'metodopago_id',
        'registradopor',
    ];

    //  Pertenece a una orden
    public function ordencompra()
    {
    return $this->belongsTo(Ordencompra::class, 'ordencompra_id');
    }

    //  Pertenece a un método de pago
    public function metodopago()
    {
    return $this->belongsTo(Metodopago::class, 'metodopago_id');
    }
}
