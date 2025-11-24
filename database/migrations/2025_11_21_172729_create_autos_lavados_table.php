<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autos_lavados', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('auto_id')->constrained('autos')->onDelete('cascade');
            $table->foreignId('lavado_id')->constrained('lavados')->onDelete('cascade');
        
            $table->date('fecha')->nullable();
            $table->decimal('precio_final', 10, 2)->nullable();
            $table->text('observaciones')->nullable();
        
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('autos_lavados');
    }
};
