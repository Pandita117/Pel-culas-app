<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('directors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->foreignId('id_nacionalidad')->constrained('nationalities')->onDelete('cascade');
            $table->date('fecha_naci');
            $table->foreignId('id_premios')->nullable()->constrained('awards')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('directors');
    }
};