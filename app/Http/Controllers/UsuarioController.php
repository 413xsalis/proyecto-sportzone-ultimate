<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index()
    {
        $Users = User::all();
        return view('administrador.Gestion_usuarios.principal', compact('user'));
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

        User::create($request->all());

              return redirect()->back()->with('success', 'Libro creado con exito');

        // return redirect()->route('administrador.Gestion_usuarios.principal')
        //     ->with('success', 'Producto creado exitosamente.');
    }

    public function show(User $Users)
    {
        return view('administrador.Gestion_usuarios.show', compact('user'));
    }

 public function edit(User $Users)
    {
        return view('administrador.Gestion_usuarios.edit', compact('user'));
    }

    public function update(Request $request, User $Users)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);
        $Users->update($request->all());

        return redirect()->route('usuario.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy(User $Users)
    {
        $Users->delete();

        return redirect()->route('usuario.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}

