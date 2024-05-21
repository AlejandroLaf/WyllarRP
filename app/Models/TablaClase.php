<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablaClase extends Model
{
    use HasFactory;

    protected $fillable = ['clase_id', 'nivel', 'stats', 'ph', 'exp', 'rasgos'];

    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }
}
