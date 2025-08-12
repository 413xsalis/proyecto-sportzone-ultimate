<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgrupo extends Model
{
    use HasFactory;

    protected $table = 'subgrupos';

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'grupo_id'
    ];

    // Relación con Grupo
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    // Relación con Estudiantes
    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_subgrupo', 'id');
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }
}
