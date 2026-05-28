<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Rol extends Model
{
    use HasFactory;
 protected $table = 'roles'; // sobreescribe la pluralización en inglés ('rols')
 protected $fillable = [ // columnas permitidas para asignación masiva
 'id', 'nombre', 'slug', 'descripcion',
 ];
 // Relación: un Rol tiene muchos Usuarios → se usa como $rol->usuarios
 public function usuarios() {
 return $this->hasMany(Usuario::class, 'perfil_id'); // 'perfil_id' es la FK en usuarios que apunta a rols
 }

}
