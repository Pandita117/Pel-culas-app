<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    protected $fillable = ['idioma', 'pais', 'continente'];

    public function actors()
    {
        return $this->hasMany(Actor::class, 'id_nacionalidad');
    }

    public function directors()
    {
        return $this->hasMany(Director::class, 'id_nacionalidad');
    }
}