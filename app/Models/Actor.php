<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['nombre_act', 'apellido_act', 'f_nac', 'id_nacionalidad', 'id_premios'];

    // Relación con Nacionalidad
    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'id_nacionalidad');
    }

    // Relación con Premio
    public function award()
    {
        return $this->belongsTo(Award::class, 'id_premios');
    }

    // Relación muchos a muchos con Películas a través de la tabla pivote 'cast'
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'cast', 'id_actor', 'id_movie')
                    ->withPivot('papel')
                    ->withTimestamps();
    }

    // Relación muchos a muchos con Series a través de la tabla pivote 'cast'
    public function series()
    {
        return $this->belongsToMany(Serie::class, 'cast', 'id_actor', 'id_serie')
                    ->withPivot('papel')
                    ->withTimestamps();
    }
}