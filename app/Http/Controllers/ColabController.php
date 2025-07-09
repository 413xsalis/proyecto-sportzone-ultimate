<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;     // Modelo de horario
use App\Models\Instructor;  // Modelo de instructor
use App\Models\Grupo;       // Modelo de grupo
use App\Models\Estudiante;

class ColabController extends Controller
{
    public function principal()
    
    {

    $instructores = \App\Models\Instructor::all();
    return view('colaborador.inicio_colab.principal', compact('instructores'));
    }

    public function gestion()
    {
        // Cargar datos necesarios para la vista
        $horarios = Horario::with(['instructor', 'grupo'])->get();
        $instructores = Instructor::all();
        $grupos = Grupo::all();

        // Pasar datos a la vista principal de gestión
        return view('colaborador.gestion_clases.principal', compact('horarios', 'instructores', 'grupos'));
    }

    public function inscripcion()
    {
        $estudiantes = Estudiante::all();
        return view('colaborador.inscripcion_estudent.principal', compact('estudiantes'));
    }

    public function reportes()
    {
        return view('colaborador.reportes.principal');
    }
}
