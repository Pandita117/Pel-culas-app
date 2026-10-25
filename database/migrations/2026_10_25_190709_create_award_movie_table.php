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
Schema::create('award_movie', function (Blueprint $table) {
    $table->id();
    $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade');
    $table->foreignId('award_id')->constrained('awards')->onDelete('cascade');
    $table->unsignedSmallInteger('anio_ganado')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('award_movie');
    }
};
