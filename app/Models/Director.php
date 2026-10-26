<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $fillable = ['nombre', 'apellido', 'id_nacionalidad', 'fecha_naci', 'id_premios'];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'id_nacionalidad');
    }

    public function award()
    {
        return $this->belongsTo(Award::class, 'id_premios');
    }

    public function movies()
    {
        return $this->hasMany(Movie::class, 'id_director');
    }

    public function series()
    {
        return $this->hasMany(Serie::class, 'id_director');
    }
}