<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    
   protected $table = 'usuarios';
 protected $fillable = ['name', 'email', 'password', 'role_id'];
 protected $hidden = ['password', 'remember_token']; // nunca expuestos en JSON
 protected function casts(): array {
 return [
 'password' => 'hashed', // hashea automáticamente al asignar
 ];
 }
 // Relación: un Usuario pertenece a un Rol → se usa como $usuario->rol
 public function rol() {
 return $this->belongsTo(Rol::class, 'rol_id');
 }
}
