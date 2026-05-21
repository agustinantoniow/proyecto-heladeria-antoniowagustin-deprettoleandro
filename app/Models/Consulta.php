<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'NombreConsulta',
        'emailConsulta',
        'Numero_telefono',
        'Mensaje',
    ];
}
 