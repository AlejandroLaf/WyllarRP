<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'FUE', 'DES', 'CON', 'PER', 'SAB', 'CAR', 'VOL', 'VIT',
        'nivel', 'defensa', 'armadura', 'armadura_magica', 'HP', 'PH', 'EXP',
        'user_id', 'clase_id', 'especializacion_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }

    public function especializacion()
    {
        return $this->belongsTo(Especializacion::class);
    }
}
