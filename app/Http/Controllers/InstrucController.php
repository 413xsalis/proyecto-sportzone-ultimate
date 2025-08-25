<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstrucController extends Controller
{
    public function index()
    {
        return view('instructor.inicio.principal');
    }

    public function principal()
    {
        return view('instructor.inicio.principal');
    }

    public function horario()
    {
        return view('instructor.horario.principal');
    }

    public function asistencia()
    {
        return view('instructor.asistencia.principal');
    }
}


