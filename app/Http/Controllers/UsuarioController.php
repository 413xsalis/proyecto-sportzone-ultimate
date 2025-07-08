<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index()
    {
        $Users = User::all();
        return view('administrador.Gestion_usuarios.principal', compact('Users'));
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

    public function show(User $Users)
    {
        return view('administrador.Gestion_usuarios.show', compact('Users'));
    }

 public function edit(User $Users)
    {
        return view('administrador.Gestion_usuarios.edit', compact('Users'));
    }

 public function update(Request $request, User $user) // Mejor nombre en singular
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'password' => 'nullable|min:8|confirmed'
    ]);

    $data = $request->only(['name', 'email']);
    
    if ($request->password) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('usuario.index')
        ->with('success', 'Usuario actualizado exitosamente');
}
    public function destroy(User $Users)
    {
        $Users->delete();

        return redirect()->route('usuario.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}

