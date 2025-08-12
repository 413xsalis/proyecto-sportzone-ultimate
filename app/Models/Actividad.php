<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    protected $fillable = [
        'horario_id',
        'subgrupo_id',
        'actividad',
        'estado'
    ];

    // Relación con Horario
    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    // Relación con Subgrupo
    public function subgrupo()
    {
        return $this->belongsTo(Subgrupo::class);
    }
}
