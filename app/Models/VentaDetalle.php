<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    // ACÁ ESTÁ LA CLAVE:
    // Decile a Laravel que el nombre exacto en tu BD es 'venta_detalles'
    protected $table = 'venta_detalles';

    protected $fillable = [
        'venta_cabecera_id', 
        'producto_id', 
        'cantidad', 
        'precio_unitario', 
        'subtotal'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}