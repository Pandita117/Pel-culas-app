<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = ['genero', 'descripcion'];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'id_genero');
    }

    public function series()
    {
        return $this->hasMany(Serie::class, 'id_genero');
    }
}