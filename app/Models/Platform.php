<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = ['nombre', 'costo'];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'id_plataforma');
    }

    public function series()
    {
        return $this->hasMany(Serie::class, 'id_plataforma');
    }
}