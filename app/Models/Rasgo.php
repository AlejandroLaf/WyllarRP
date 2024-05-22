<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rasgo extends Model
{
    use HasFactory;

    public function clases()
    {
        return $this->belongsToMany(Clase::class, 'rasgos_clase');
    }

    public function especializaciones()
    {
        return $this->belongsToMany(Especializacion::class, 'rasgos_especializacion')->withPivot('nivel');
    }

    public function personajes()
{
    return $this->belongsToMany(Personaje::class, 'rasgos_personaje');
}
}
