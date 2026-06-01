<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedor extends Model
{
   
    use HasFactory;
    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    protected $fillable = [
    'nombre',
    'documento',
    'direccion',
    'telefono',
    'email',
    'estado',
    'registradopor'
    ];
    // Relación con OrdenCompra (uno a muchos)
    public function ordencompras()
    {
    return $this->hasMany(OrdenCompra::class, 'proveedor_id');
    }
}
