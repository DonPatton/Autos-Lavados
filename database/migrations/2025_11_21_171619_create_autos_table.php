<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->string('patente')->unique();      // ej abc123
            $table->string('marca')->nullable();      // ej Toyota
            $table->string('modelo')->nullable();     // ej Corolla
            $table->string('color')->nullable();
            $table->string('propietario')->nullable(); //nombre del dueño
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autos');
    }
};
