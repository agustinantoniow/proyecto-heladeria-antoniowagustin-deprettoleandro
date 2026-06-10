<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consulta extends Model
{
    
    protected $fillable = [
        'nombre', 
        'email', 
        'numero_telefono', 
        'tipo', 
        'mensaje',
        'leido' // <--- AGREGÁ ESTO
    ];
       
    // Recomendación: Si tu tabla no tiene columnas 'created_at', 
    // Laravel a veces se queja. Si las tenés, esto está perfecto así.
}