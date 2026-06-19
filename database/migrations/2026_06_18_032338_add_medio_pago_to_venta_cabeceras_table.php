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
        Schema::table('venta_cabeceras', function (Blueprint $table) {
            $table->string('medio_pago')->nullable()->after('tipo_entrega');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('venta_cabeceras', function (Blueprint $table) {
            $table->dropColumn('medio_pago');
        });
    }
};