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
    Schema::create('venta_detalles', function (Blueprint $table) {
        $table->id();
        // Conecta este renglón con la cabecera del carrito
        $table->foreignId('venta_cabecera_id')->constrained('venta_cabeceras')->onDelete('cascade');
        // Conecta con el helado que está comprando
        $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
        
        $table->integer('cantidad');
        $table->decimal('precio_unitario', 10, 2);
        $table->decimal('subtotal', 10, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_detalles');
    }
};
