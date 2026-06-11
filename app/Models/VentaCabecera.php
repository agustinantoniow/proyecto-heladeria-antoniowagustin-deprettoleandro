<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\VentaDetalle; 

class VentaCabecera extends Model
{
    protected $table = 'venta_cabeceras';
    protected $fillable = ['user_id', 'estado', 'total', 'fecha_venta'];
    protected $casts = ['fecha_venta' => 'datetime'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detalles()
    {
        // Cambiamos 'venta_id' por 'venta_cabecera_id' para que coincida con la migración
        return $this->hasMany(VentaDetalle::class, 'venta_cabecera_id');
    }
}
