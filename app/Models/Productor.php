<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productor extends Model
{
    protected $fillable = ['nombre_productora'];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'id_productora');
    }

    public function series()
    {
        return $this->hasMany(Serie::class, 'id_productora');
    }
}