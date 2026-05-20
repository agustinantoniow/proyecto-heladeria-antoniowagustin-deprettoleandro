<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
<<<<<<< HEAD
        'categoria',
        'descripcion',
        'precio',
        'stock',
        'activo',
    ];
=======
        'descripcion',
        'precio',
        'stock',
        'url_imagen',
        'activo',
        ];
protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'activo' => 'boolean',
        ];

>>>>>>> bc2483854b38680d731d03e84f671f683e59de0f
}
