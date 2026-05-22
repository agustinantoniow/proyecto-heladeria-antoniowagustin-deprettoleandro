<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // Recomendado para login

class Usuario extends Authenticatable
{
    use Notifiable;

    // Nombre de la tabla en MariaDB
    protected $table = 'usuarios';

    // Campos que permitimos que se completen desde el formulario (Mass Assignment)
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'usuario',
        'password',
        'perfil_id', // Acá es donde vas a guardar el 0 o 1 de tu admin
        'estado',
    ];

    // Campos que nunca deben mostrarse al convertir el objeto a JSON o Array
    protected $hidden = [
        'password',
    ];

    // Opcional: Esto ayuda a Laravel a saber que la contraseña debe ser encriptada
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}