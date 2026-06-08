<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'categoria_id',
        'descripcion',
        'precio',
        'stock',
        'activo',
         'imagen'
];
public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
