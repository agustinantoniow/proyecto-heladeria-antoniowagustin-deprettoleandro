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
    Schema::create('venta_cabeceras', function (Blueprint $table) {
        $table->id();
        
        // 1. Primero creamos la columna suelta (asegurate que sea unsignedBigInteger, que es el estándar de Laravel para IDs)
        $table->unsignedBigInteger('user_id');
        
        // 2. Después le decimos a MariaDB con quién se conecta exactamente
        // ACÁ ESTÁ LA CLAVE: Cambiá 'usuarios' por el nombre real de tu tabla en la base de datos
        $table->foreign('user_id')->references('id')->on('usuarios')->onDelete('cascade');
        
        $table->string('estado')->default('pendiente'); 
        $table->decimal('total', 10, 2)->default(0);
        $table->timestamp('fecha_venta')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_cabeceras');
    }
};
