<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_act', 'apellido_act', 'f_nac', 'id_nacionalidad', 'id_premios'];

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
        return $this->belongsToMany(Movie::class, 'actor_movie');
    }

    public function series()
{
    return $this->belongsToMany(Serie::class, 'actor_series', 'actor_id', 'series_id');
}
}