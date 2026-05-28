<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

       
        // Por esto:
        Schema::create('roles', function (Blueprint $table) {
        $table->id(); // Este es el ID al que apuntaremos
        $table->string('nombre');
        $table->string('descripcion')->nullable();
        $table->string('slug');
        $table->timestamps();
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};

