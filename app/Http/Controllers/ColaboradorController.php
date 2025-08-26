<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Grupo;
use App\Models\Estudiante;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ColaboradorController extends Controller
{
    public function index()
    {
        // Obtener solo usuarios con rol de instructor
        $instructores = User::role('instructor')->get();
        return view('colaborador.inicio_colab.principal', compact('instructores'));
    }

    public function principal()
    {
        // Obtener solo usuarios con rol de instructor
        $instructores = User::role('instructor')->get();
        return view('colaborador.inicio_colab.principal', compact('instructores'));
    }

   public function gestion()
{
    // Cargar datos necesarios para la vista
    $horarios = Horario::with(['instructor', 'grupo'])->get();
    
    // Obtener solo usuarios con rol de instructor
    $instructores = User::role('instructor')->get();
    
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
