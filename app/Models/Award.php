<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    protected $fillable = ['fecha_creacion', 'nombre_premio'];

    public function actors()
    {
        return $this->hasMany(Actor::class, 'id_premios');
    }

    public function directors()
    {
        return $this->hasMany(Director::class, 'id_premios');
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'award_movie')->withPivot('anio_ganado');
    }

    public function series()
{
    return $this->belongsToMany(Serie::class, 'award_series', 'award_id', 'series_id');
}
}