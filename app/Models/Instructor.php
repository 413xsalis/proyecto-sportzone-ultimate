<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model

{
    protected $table = 'instructores';
    
    protected $fillable = [
        'nombre',
        'documento',
        'telefono',
        'especialidad',
    ];

}
