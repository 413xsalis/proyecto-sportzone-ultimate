<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $primaryKey = 'documento';
    public $incrementing = false;
    public $timestamps = true;


    //     public function grupoNivel()
    // {
    //     return $this->belongsTo(GrupoNivel::class, 'id_grupo_nivel', 'id_grupo_nivel');
    // }

    // // Relación con grupo (por campo documento)
    // public function grupo()
    // {
    //     return $this->hasOne(Grupo::class, 'documento', 'documento');
    // }

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
        'id_grupo_nivel'
    ];
}
