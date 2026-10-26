<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = [
        'titulo',
        'id_director',
        'id_genero',
        'id_clasificacion',
        'id_productora',
        'id_plataforma',
        'id_premios',
        'cantidad_premios',
        'fecha_lanzamiento',
        'cant_episodios',
        'presupuesto'
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

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'id_plataforma');
    }

    public function award()
    {
        return $this->belongsTo(Award::class, 'id_premios');
    }

    // Relación con Actores (Tabla intermedia cast)
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'cast', 'id_serie', 'id_actor')
                    ->withPivot('papel')
                    ->withTimestamps();
    }

    // Relación con Reseñas / Calificaciones
    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_serie');
    }
}