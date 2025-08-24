<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Instructor;
use App\Models\Horario;
use Carbon\Carbon;
use App\Models\User;


class AdminController extends Controller
{
    public function principal()
    {
        // Total de alumnos
        $totalAlumnos = Estudiante::count();
        
        // Total de instructores
        $totalInstructores = Instructor::count();
        
        // Obtener el día actual en español
        $dias = [
            'Sunday' => 'Domingo',
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado'
        ];
        $diaActual = $dias[Carbon::now()->format('l')];
        
        // Clases programadas para hoy
        $clasesHoy = Horario::with(['instructor', 'grupo'])
            ->where('dia', $diaActual)
            ->orderBy('hora_inicio')
            ->get();
            
        $clasesHoyCount = $clasesHoy->count();
        
        // Todos los instructores
        $instructores = Instructor::all();

        return view('administrador.admin.principal', compact(
            'totalAlumnos', 
            'totalInstructores', 
            'clasesHoy', 
            'clasesHoyCount',
            'instructores'
        ));
    }
    public function index(){
        return view('administrador.admin.principal');
    }


    public function create()
    {
        return view('administrador.Gestion_usuarios.create');
    }








    
    /**
     * Muestra la gestión de usuarios con productos
     */
    public function gestion()
    {
        $users = User::with('roles')->paginate(10);
        $totalUsers = User::withTrashed()->count();
        $activeUsers = User::whereNull('deleted_at')->count();
        $inactiveUsers = User::onlyTrashed()->count();

        return view('administrador.Gestion_usuarios.principal', compact('users', 'totalUsers', 'activeUsers', 'inactiveUsers'));
    }
}