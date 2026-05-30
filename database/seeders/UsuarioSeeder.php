<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nombre'            => 'Antonio',
            'apellido'          => 'Depretto',
            'usuario'           => 'antonio_admin',
            'email'             => 'admin@heladeriaglace.com',
            'password'          => Hash::make('password123'), // Contraseña encriptada segura
            'perfil_id'         => 1,                         // 1 = Admin (según tu RolesSeeder)
            'estado'            => true,
        ]);
        User::create([
            'nombre'            => 'Agustín',
            'apellido'          => 'Leandro',
            'usuario'           => 'agustin_cliente',
            'email'             => 'cliente@example.com',
            'password'          => Hash::make('password123'),
            'perfil_id'         => 2,                         // 2 = Cliente
            'estado'            => true,
        ]);
    }
}
