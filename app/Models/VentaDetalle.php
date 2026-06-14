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
public function cabecera()
    {
        // Reemplaza 'VentaCabecera' por el nombre exacto de tu modelo de cabecera (ej: Pedido o Venta)
        return $this->belongsTo(VentaCabecera::class, 'venta_cabecera_id'); 
    }

    
}
    