<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Instructor;
use App\Models\Horario;
use Carbon\Carbon;
use App\Models\User;

class AdminController extends Controller
{
public function index()
    {
        return $this->principal();
    }

    public function principal()
    {
        // Total de alumnos
        $totalAlumnos = Estudiante::count();
        
        // Total de instructores
        $totalInstructores = User::count();
        
        // Obtener la fecha actual
        $fechaActual = Carbon::now()->format('Y-m-d');
        
        // Clases programadas para hoy - usando la columna 'fecha'
        $clasesHoy = Horario::with(['instructor', 'grupo'])
            ->whereDate('fecha', $fechaActual)
            ->orderBy('hora_inicio')
            ->get();
            
        $clasesHoyCount = $clasesHoy->count();
        
        // Todos los instructores
        $instructores = User::all();

        return view('administrador.admin.principal', compact(
            'totalAlumnos', 
            'totalInstructores', 
            'clasesHoy', 
            'clasesHoyCount',
            'instructores'
        ));
    }

    public function create()
    {
        return view('administrador.Gestion_usuarios.create');
    }

    public function gestion()
    {
        $users = User::with('roles')->paginate(10);
        $totalUsers = User::withTrashed()->count();
        $activeUsers = User::whereNull('deleted_at')->count();
        $inactiveUsers = User::onlyTrashed()->count();

        return view('administrador.Gestion_usuarios.principal', compact('users', 'totalUsers', 'activeUsers', 'inactiveUsers'));
    }
}