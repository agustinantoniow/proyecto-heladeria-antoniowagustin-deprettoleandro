<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
{
    // Cambiamos 'rols' por 'roles' para que coincida con la restricción de 'usuarios'
    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 100);
        $table->string('slug')->default('default-slug');
        $table->text('descripcion')->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
}

public function down(): void
{
    // Corregimos el down para que simplemente borre la tabla
    Schema::dropIfExists('roles');
}
};
