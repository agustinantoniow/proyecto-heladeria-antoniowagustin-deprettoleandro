<?php

namespace Database\Seeders;
use App\Models\Rol;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// 
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
        ['id' => 1, 'nombre' => 'admin', 'slug' => 'admin', 'descripcion' => 'Administrador del sistema'],
        ['id' => 2, 'nombre' => 'cliente', 'slug' => 'cliente', 'descripcion' => 'Cliente del ecommerce'],
 ];
 foreach ($roles as $rol) {
 // firstOrCreate evita duplicados si se ejecuta más de una vez
 Rol::firstOrCreate(['id' => $rol['id']], $rol);
 }

    }
}
