<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'instructor_id',
        'grupo_id',
    ];

    // Relación con Instructor (User)
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    // Relación con Grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
}