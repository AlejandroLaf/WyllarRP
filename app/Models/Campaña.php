<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaña extends Model
{
    use HasFactory;

    protected $table = 'campañas';

    protected $fillable = [
        'nombre', 'codigo'
    ];

    public function creadores()
    {
        return $this->belongsToMany(User::class, 'campaña_creador');
    }

    public function jugadores()
    {
        return $this->belongsToMany(User::class, 'jugadores_campaña');
    }

    public function jugadorEnCampaña($usuario_id)
    {
        return $this->jugadores()->where('id', $usuario_id)->exists();
    }

    public function todosLosUsuarios()
    {
        return $this->creadores->merge($this->jugadores);
    }
}
