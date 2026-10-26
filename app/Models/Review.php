<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['id_movie', 'id_serie', 'calificacion', 'resena'];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'id_movie');
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'id_serie');
    }
}