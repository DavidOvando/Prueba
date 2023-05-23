<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignarPelicula extends Model
{
    use HasFactory;
    protected $table = 'actores_peliculas';
    protected $fillable = [
        'actor',
        'pelicula'
    ];
}
