<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // 1. Campos que se pueden llenar masivamente desde los formularios o controladores
    protected $fillable = ['nombre', 'descripcion', 'slug'];

    // 2. Relación: Una categoría tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}
