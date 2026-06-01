<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metodopago extends Model
{
    use HasFactory;

    protected $table = 'metodopagos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'registradopor'
    ];

    //  Un método tiene muchos pagos
    public function pagos()
    {
    return $this->hasMany(Pago::class, 'metodopago_id');
    }
}
