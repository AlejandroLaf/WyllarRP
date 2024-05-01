<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public function mensajes()
{
    return $this->hasMany(Mensaje::class);
}

public function usuarios()
{
    return $this->belongsToMany(User::class, 'chat_usuario')
                ->withPivot('hablar');
}

public function campaña()
{
    return $this->belongsTo(Campaña::class);
}

public function unirseAChat($usuario, $permisoHablar)
{
    $this->usuarios()->attach($usuario, ['hablar' => $permisoHablar]);
}

public static function crear($nombre, $campaña)
{
    $chat = new static();
    $chat->nombre = $nombre;
    $chat->campaña()->associate($campaña);
    $chat->save();

    return $chat;
}
}
