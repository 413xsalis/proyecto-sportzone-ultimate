<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoNivel extends Model
{
    // Si la tabla no usa la convención plural, puedes especificarlo aquí
    protected $table = 'grupos_nivel'; // Cambia esto si tu tabla tiene un nombre diferente

    // Si el nombre de la clave primaria es diferente (por ejemplo, si no es 'id')
    protected $primaryKey = 'id_grupo_nivel';  // Cambia esto si la clave primaria tiene otro nombre

    // Si no utilizas timestamps
    public $timestamps = false;
}
