<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    public function personajes()
    {
        return $this->hasMany(Personaje::class);
    }

    public function especializaciones()
    {
        return $this->hasMany(Especializacion::class);
    }

    public function tablaClases()
    {
        return $this->hasMany(TablaClase::class);
    }

    public function habilidades()
{
    return $this->belongsToMany(Habilidad::class, 'habilidades_clase');
}

}
