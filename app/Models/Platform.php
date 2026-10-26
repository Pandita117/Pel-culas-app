<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'costo'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_platform');
    }

    public function series()
    {
        return $this->belongsToMany(Serie::class, 'platform_series');
    }
}