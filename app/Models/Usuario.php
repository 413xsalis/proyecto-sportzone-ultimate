<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['name', 'email'];
    // protected $fillable = ['name', 'description', 'price'];
}
