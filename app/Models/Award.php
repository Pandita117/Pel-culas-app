<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
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
        return $this->hasMany(Movie::class, 'id_premios');
    }

    public function series()
    {
        return $this->hasMany(Serie::class, 'id_premios');
    }
}