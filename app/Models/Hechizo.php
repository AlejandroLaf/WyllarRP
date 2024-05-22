<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hechizo extends Model
{
    use HasFactory;

    public function clases()
    {
        return $this->belongsToMany(Clase::class, 'hechizos_clase');
    }

    public function especializaciones()
    {
        return $this->belongsToMany(Especializacion::class, 'hechizos_especializacion');
    }

    public function personajes()
{
    return $this->belongsToMany(Personaje::class, 'hechizos_personaje');
}
}
