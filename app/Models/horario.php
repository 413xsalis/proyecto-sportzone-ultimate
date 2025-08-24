<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructor;
use App\Models\Grupo;

class Horario extends Model
{

    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'grupo_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
    ];

    public function instructor() {
        return $this->belongsTo(Instructor::class, );
    }

    public function grupo() {
        return $this->belongsTo(Grupo::class, );
    }
}
