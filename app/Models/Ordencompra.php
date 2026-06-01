<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ordencompra extends Model
{
    use HasFactory;
    protected $table = 'ordencompras';
    protected $fillable = [
    'fecha',
    'proveedor_id',
    'total',
    'tipopago',
    'saldopendiente',
    'estado',
    'registradopor'
    ];

    //  Una orden pertenece a un proveedor
    public function proveedor()
    {
    return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    //  Una orden tiene muchos detalles
    public function detallescompras()
    {
    return $this->hasMany(Detallecompra::class, 'ordencompra_id');
    }

    //  Una orden tiene muchos pagos
    public function pagos()
    {
    return $this->hasMany(Pago::class, 'ordencompra_id');
    }
}
