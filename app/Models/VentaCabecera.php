<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use app\Models\VentaDetalle;
class VentaCabecera extends Model
{
    protected $fillable = 
    [ 'user_id', 'estado', 'total', 'fecha_venta', ];
    protected $casts = [  'fecha_venta' => 'datetime', ];  
    public function usuario() { 
        return $this->belongsTo(User::class, 'user_id'); 
        
        } 
        public function detalles() { 
            return $this->hasMany(VentaDetalle::class, 'venta_id'); }
}
