<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 100)->unique();
            $table->string('usuario', 50)->unique()->nullable(); // Agregamos el campo 'usuario' como único y opcional
            $table->string('password');
            
            // ACÁ ESTÁ EL CAMBIO: 'perfiles' por 'roles'
            $table->foreignId('perfil_id') 
                  ->constrained('roles') 
                  ->onDelete('cascade');
                  
            $table->boolean('estado')->default(true);
            $table->timestamps();                
        });
    }
     
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
