<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VentaDetalle; 

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

    // Relación: Un producto puede estar en muchos "detalles" de ventas
    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class, 'producto_id');
    }
}