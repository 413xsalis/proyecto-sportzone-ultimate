<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencia';

    public $timestamps = false;

    // Clave primaria compuesta
    protected $primaryKey = ['fecha', 'documento_estudiante'];
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'fecha',
        'documento_estudiante',
        'id_grupo',
        'estado',
    ];
}
