<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $primaryKey = 'documento';
    public $incrementing = false;
    public $timestamps = true;


    protected $fillable = [
        'documento',
        'nombre_1',
        'nombre_2',
        'apellido_1',
        'apellido_2',
        'telefono',
        'nombre_contacto',
        'telefono_contacto',
        'eps',
        'grupo_id',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
}
