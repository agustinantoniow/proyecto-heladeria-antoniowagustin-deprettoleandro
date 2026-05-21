<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');          // Ej: "Dulce de Leche Granizado" o "Cucurucho"
        $table->string('categoria');       // Ej: "Helados", "Postres", "Bebidas"
        $table->text('descripcion')->nullable(); // Por si querés aclarar los ingredientes
        $table->decimal('precio', 8, 2);   // Para el precio por kilo o por unidad
        $table->integer('stock')->default(0); // Cantidad disponible (en kg o unidades)
        $table->boolean('activo')->default(true); // Para ocultar un producto si se queda sin stock
        $table->timestamps();              // Crea las columnas created_at y updated_at automáticamente
    });
}
};
