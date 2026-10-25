<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_act');
            $table->string('apellido_act');
            $table->date('f_nac');
            $table->foreignId('id_nacionalidad')->constrained('nationalities')->onDelete('cascade');
            $table->foreignId('id_premios')->nullable()->constrained('awards')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actors');
    }
};