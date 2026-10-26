<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasification extends Model
{
    use HasFactory;

    protected $fillable = ['clasificacion', 'rango', 'descripcion'];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'id_clasificacion');
    }

    public function series()
    {
        return $this->hasMany(Serie::class, 'id_clasificacion');
    }
}