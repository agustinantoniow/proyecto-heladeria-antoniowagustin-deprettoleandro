<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('venta_cabeceras', function (Blueprint $table) {
            // Agregamos las nuevas columnas solicitadas para el checkout
            $table->string('dni')->nullable()->after('estado');
            $table->string('telefono')->nullable()->after('dni');
            $table->string('tipo_entrega')->nullable()->after('telefono');
            $table->string('direccion')->nullable()->after('tipo_entrega');
            $table->string('metodo_pago')->nullable()->after('direccion');
            $table->string('codigo_seguimiento')->nullable()->after('metodo_pago');
            
            // LÍNEA COMENTADA PARA EVITAR EL ERROR 1060 (Duplicado)
            // $table->timestamp('fecha_venta')->nullable()->after('codigo_seguimiento');
        });
    }

    public function down()
    {
        Schema::table('venta_cabeceras', function (Blueprint $table) {
            // En caso de querer revertir la migración, borramos estas columnas
            $table->dropColumn([
                'dni', 
                'telefono', 
                'tipo_entrega', 
                'direccion', 
                'metodo_pago', 
                'codigo_seguimiento'
                // 'fecha_venta' // También la anulamos acá
            ]);
        });
    }
};