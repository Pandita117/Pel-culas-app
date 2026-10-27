<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
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
        'cant_episodios'
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
    // El 2do parámetro es la tabla pivote y el 3ro es la llave foránea de la serie
    return $this->belongsToMany(Actor::class, 'actor_series', 'series_id', 'actor_id');
}
    // Relación N:M con Plataformas
    public function platforms()
{
    // 2do parámetro: tabla pivote | 3er parámetro: tu foreign key (series_id) | 4to parámetro: platform_id
    return $this->belongsToMany(Platform::class, 'platform_series', 'series_id', 'platform_id');
}

    // Relación N:M con Premios
    public function awards()
{
    // 2do parámetro: tabla pivote | 3er parámetro: tu foreign key (series_id) | 4to parámetro: award_id
    return $this->belongsToMany(Award::class, 'award_series', 'series_id', 'award_id')->withPivot('anio_ganado');
}

    // Relación con Reseñas
    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_serie');
    }
}