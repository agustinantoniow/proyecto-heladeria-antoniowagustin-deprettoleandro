<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use Database\models\Usuario;
use App\Models\Categoria;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RolesSeeder::class 
        ]);
        $this->call(UsuarioSeeder::class);
     User::factory()->create([
    'nombre' => 'Test',
    'apellido' => 'User',
    'usuario' => 'testuser',
    'email' => 'test@example.com',
    'password' => bcrypt('password'),
    'perfil_id' => 1, 
    'estado' => true
]);

\App\Models\Categoria::firstOrCreate(['nombre' => 'Helados de agua']);
        \App\Models\Categoria::firstOrCreate(['nombre' => 'Postres']);
        \App\Models\Categoria::firstOrCreate(['nombre' => 'Línea familiar (pote)']);
    }
}
