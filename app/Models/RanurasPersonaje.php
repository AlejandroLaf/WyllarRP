<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RanurasPersonaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'personaje_id',
        'ranuraMax1',
        'ranuraMax2',
        'ranuraMax3',
        'ranuraMax4',
        'ranuraMax5',
        'ranuraActual1',
        'ranuraActual2',
        'ranuraActual3',
        'ranuraActual4',
        'ranuraActual5',
    ];

    public function personaje()
    {
        return $this->belongsTo(Personaje::class,'ranuras_personaje');
    }

}
