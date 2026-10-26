<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'id_director',
        'id_genero',
        'id_clasificacion',
        'id_productora',
        'cantidad_premios',
        'fecha_lanzamiento',
        'duracion'
    ];

    public function director()
    {
        return $this->belongsTo(Director::class, 'id_director');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'id_genero');
    }

    public function clasification()
    {
        return $this->belongsTo(Clasification::class, 'id_clasificacion');
    }

    public function productor()
    {
        return $this->belongsTo(Productor::class, 'id_productora');
    }

    // Relación N:M con Actores
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actor_movie');
    }

    // Relación N:M con Plataformas
    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'movie_platform');
    }

    // Relación N:M con Premios
    public function awards()
    {
        return $this->belongsToMany(Award::class, 'award_movie')->withPivot('anio_ganado');
    }

    // Relación con Reseñas
    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_movie');
    }
}