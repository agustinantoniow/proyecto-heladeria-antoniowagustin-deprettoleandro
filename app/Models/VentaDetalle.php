<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    protected $table = 'ventas_detalle'; 
    protected $fillable = [ 'venta_id', 'producto_id', 'cantidad', 'precio_unitario', 'subtotal', ]; 
    public function venta() {
        return $this->belongsTo(VentaCabecera::class, 'venta_id'); 
        } 
        // Relación: un detalle apunta a un producto public function producto() { return $this->belongsTo(Producto::class, 'producto_id'); }
        public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
