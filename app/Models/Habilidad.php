<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    use HasFactory;

    public function clases()
{
    return $this->belongsToMany(Clase::class, 'habilidades_clase');
}

public function especializaciones()
{
    return $this->belongsToMany(Clase::class, 'habilidades_especializacion');
}

}
