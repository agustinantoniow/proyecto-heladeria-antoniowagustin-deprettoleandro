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
    // Usamos 'users' porque vimos en Tinker que tu tabla se llama así por defecto
    Schema::create('rols', function (Blueprint $table) {
      $table->id();
        $table->string('nombre', 100);
        $table->text('descripcion')->nullable();
         $table->timestamps();
    });
}

public function down(): void
{
    Schema::create('rols', function (Blueprint $table) {
        $table->dropForeign(['role_id']);
        $table->dropColumn('role_id');
    });
}
};
