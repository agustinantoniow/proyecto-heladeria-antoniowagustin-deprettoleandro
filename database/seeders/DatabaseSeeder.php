<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Asegurate de que estos nombres coincidan exactamente con los archivos de tu compañero
use Database\Seeders\RolesSeeder;
use Database\Seeders\UsuarioSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Llamamos a los Seeders que armó el equipo
        $this->call([
            RolesSeeder::class,
            UsuarioSeeder::class
        ]);

        // 2. Creamos las categorías de los helados
        \App\Models\Categoria::firstOrCreate(['nombre' => 'Helados de agua']);
        \App\Models\Categoria::firstOrCreate(['nombre' => 'Postres']);
        \App\Models\Categoria::firstOrCreate(['nombre' => 'Línea familiar (pote)']);
    }
}