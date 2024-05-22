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

    public function ranurasPersonaje()
    {
        return $this->hasOne(RanurasPersonaje::class,'ranuras_personaje');
    }

    public function habilidades()
    {
        return $this->belongsToMany(Habilidad::class, 'habilidades_personaje');
    }

    public function rasgos()
    {
        return $this->belongsToMany(Rasgo::class, 'rasgos_personaje');
    }

    public function hechizos()
    {
        return $this->belongsToMany(Hechizo::class,'hechizos_personaje')->withPivot('nivel');
    }
}
