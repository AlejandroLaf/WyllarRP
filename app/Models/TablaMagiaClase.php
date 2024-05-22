<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablaMagiaClase extends Model
{
    use HasFactory;

    protected $table = 'tabla_magia_clase';

    protected $fillable = [
        'clase_id',
        'ranuras1',
        'ranuras2',
        'ranuras3',
        'ranuras4',
        'ranuras5',
        'hechizos1',
        'hechizos2',
        'hechizos3',
        'hechizos4',
        'hechizos5',
        'nivel'
    ];

    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }
}
