<?php

namespace App\Http\Controllers; // Namespace añadido

use App\Models\User;
use Illuminate\Http\Request;
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        

        $empleadosActivos = User::role(['admin', 'colaborador', 'instructor'])
            ->where('estado', 'activo')
            ->get();

        $empleadosInactivos = User::role(['admin', 'colaborador', 'instructor'])
            ->where('estado', 'inactivo')
            ->get();

        $alumnosActivos = User::role('alumno')
            ->where('estado', 'activo')
            ->get();

        $alumnosRetirados = User::role('alumno')
            ->where('estado', 'retirado')
            ->get();

        return view('principal.blade.php', compact(
            'empleadosActivos',
            'empleadosInactivos',
            'alumnosActivos',
            'alumnosRetirados'
        ));
    }



    // public function activeUsers()
    // {
    //     $usuari = User::where('is_active', true)
    //         ->whereNull('deleted_at')
    //         ->get();

    //     return view('administrador.Formulario_empleados.principal', [
    //         'Users' => $usuari// Pasando explícitamente la variable
    //     ]);
    // }

    // public function inactiveUsers()
    // {
    //     $users = User::where('is_active', false)
    //         ->orWhereNotNull('deleted_at')
    //         ->get();
    //     return view('admin.users.inactive', compact('users'));
    // }

    // public function deactivate(User $user) // Cambiado de desactivate a deactivate
    // {
    //     $user->update(['is_active' => false]);
    //     return redirect()->route('admin.users.active')->with('success', 'Usuario desactivado correctamente');
    // }

    // public function activate(User $user)
    // {
    //     $user->update(['is_active' => true]);
    //     return redirect()->route('admin.users.inactive')->with('success', 'Usuario activado correctamente');
    // }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.active')->with('success', 'Usuario eliminado correctamente');
    }
}