<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lavados', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // Exterior, Completo, Pulido
            $table->decimal('precio', 10, 2); // precio base del lavado
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lavados');
    }
};
