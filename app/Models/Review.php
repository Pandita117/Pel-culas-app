<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Apunta a la tabla ratings
    protected $table = 'ratings';

    protected $fillable = ['id_movie', 'id_serie', 'calificacion', 'Reseña'];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'id_movie');
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'id_serie');
    }
}