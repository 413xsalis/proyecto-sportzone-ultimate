<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estudiante;
use App\Models\Subgrupo;


class Asistencia extends Model
{
    protected $table = 'asistencias';

    public $timestamps = false;

    // Clave primaria compuesta
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'estudiante_documento',
        'subgrupo_id',
        'fecha',
        'estado'
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_documento', 'documento');
    }

    public function subgrupo()
    {
        return $this->belongsTo(Subgrupo::class, 'subgrupo_id', 'id');
    }
}
