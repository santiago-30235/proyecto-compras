<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;
    
    protected $table = 'productos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'preciocompra',
        'descripcion',
        'stockmaximo',
        'stock',
        'imagen',
        'estado',
        'registradopor'
    ];

    //  Un producto aparece en muchos detalles
    public function detallescompras()
    {
    return $this->hasMany(Detallecompra::class, 'producto_id');
    }
}
