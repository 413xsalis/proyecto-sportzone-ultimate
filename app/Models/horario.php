<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor;
use App\Models\Grupo;

class Horario extends Model
{
    protected $fillable = [
        'instructor_id',
        'grupo_id',
        'dia',
        'hora_inicio',
        'hora_fin',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }
}
