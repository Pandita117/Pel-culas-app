<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->foreignId('id_director')->nullable()->constrained('directors')->onDelete('cascade');
            $table->foreignId('id_genero')->nullable()->constrained('genders')->onDelete('cascade');
            $table->foreignId('id_clasificacion')->nullable()->constrained('clasifications')->onDelete('cascade');
            $table->foreignId('id_productora')->nullable()->constrained('productors')->onDelete('cascade');
            $table->foreignId('id_plataforma')->nullable()->constrained('platforms')->onDelete('cascade');
            $table->foreignId('id_premios')->nullable()->constrained('awards')->onDelete('cascade');
            $table->integer('cantidad_premios')->default(0);
            $table->date('fecha_lanzamiento');
            $table->integer('cant_episodios');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};