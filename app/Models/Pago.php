<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'estudiante_documento',
        'fecha_pago',
        'valor',
        'medio_pago',
        'tipo',
        'concepto',
        'estado',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_documento', 'documento');
    }

} 