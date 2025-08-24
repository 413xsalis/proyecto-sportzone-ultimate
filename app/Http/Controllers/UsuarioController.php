<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $users = User::with('roles')->get();

        $users = User::with('roles')->paginate(10);
        $totalUsers = User::withTrashed()->count();
        $activeUsers = User::whereNull('deleted_at')->count();
        $inactiveUsers = User::onlyTrashed()->count();

        return view('administrador.Gestion_usuarios.principal', compact('users', 'totalUsers', 'activeUsers', 'inactiveUsers'));
    }


    public function trashed()
    {
        $users = User::onlyTrashed()->latest()->get();
        return view('administrador.Gestion_usuarios.trashed', compact('users'));


    }


    public function create()
    {
        return view('administrador.Gestion_usuarios.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // ¡Importante hashear la contraseña!
        ]);

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $usuario)
    {
        return view('administrador.Gestion_usuarios.show', compact('usuario'));
    }

    public function edit(User $usuario)
    {
        return view('administrador.Gestion_usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        $usuario->update($request->all());

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    
    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario eliminado exitosamente');
    }
}

