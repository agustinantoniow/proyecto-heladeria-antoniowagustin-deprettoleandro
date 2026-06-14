<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    // Si tu tabla en la base de datos no se llama "ventas", indícalo acá (ej: 'detalle_ventas')
    // protected $table = 'ventas';

    // CAMPOS PERMITIDOS PARA REGISTRAR (Asegúrate de que coincidan con tus columnas)
    protected $table = 'venta_Detalles';
   
    protected $fillable = [
        'producto_id',
        'cantidad',
        'precio_unitario'
    ];

    // LA RELACIÓN CLAVE: Una venta pertenece a un Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}