<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model

{
    use HasFactory;

    protected $table = 'instructores';
    
    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'telefono',
        'email',
    ];

      public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

}
