<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class InstructorController extends Controller
{
    public function index()
    {
        // Obtener usuarios con rol de instructor
        $instructores = User::role('instructor')->get();
        
        return view('colaborador.inicio_colab.principal', compact('instructores'));
    }
}