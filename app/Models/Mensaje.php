<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    public function chat()
{
    return $this->belongsTo(Chat::class);
}

public function usuario()
{
    return $this->belongsTo(User::class);
}
}
