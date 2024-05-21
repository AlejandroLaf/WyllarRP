<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especializacion extends Model
{
    use HasFactory;

    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }

    public function personajes()
    {
        return $this->hasMany(Personaje::class);
    }

    public function habilidades()
    {
        return $this->belongsToMany(Habilidad::class, 'habilidades_especializacion');
    }


}
