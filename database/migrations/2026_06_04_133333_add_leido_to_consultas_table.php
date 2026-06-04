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
        Schema::table('consultas', function (Blueprint $table) {
            // Aquí es donde pegas tu línea:
            $table->boolean('leido')->default(false)->after('mensaje');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            // Esto sirve para deshacer el cambio si haces un 'migrate:rollback'
            $table->dropColumn('leido');
        });
    }
};
