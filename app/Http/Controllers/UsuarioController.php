<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;


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
        $roles = Role::all(); // Obtén todos los roles disponibles desde el modelo de Spatie
        return view('administrador.Gestion_usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // ¡Importante hashear la contraseña!
            'roles' => ['array'], // Asegura que 'roles' sea un array
            // Valida que los roles enviados existan en la tabla 'roles' de Spatie.
            // Si tu select envía los NOMBRES de los roles:
            'roles.*' => ['exists:roles,name'],
            // Si tu select envía los IDs de los roles:
            // 'roles.*' => ['exists:roles,id'],
        ]);

        // Asigna los roles al usuario usando Spatie.
        // Si el input 'roles' contiene los NOMBRES de los roles (lo más común con Spatie):
        $user->assignRole($request->input('roles', []));
        // Si el input 'roles' contiene los IDs de los roles:
        // $user->syncRoles($request->input('roles', [])); // syncRoles funciona con IDs o nombres

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function show(User $usuario)
    {
        // Los roles del usuario se pueden acceder directamente a través de $usuario->roles
        // gracias al trait HasRoles. Puedes cargarlos explícitamente si es necesario.
        $usuario->load('roles');
        return view('administrador.Gestion_usuarios.show', compact('usuario'));
    }

    public function edit(User $usuario)
    {
        $roles = Role::all(); // Obtén todos los roles disponibles de Spatie
        // Los roles asignados al usuario se obtienen con $usuario->roles (gracias a HasRoles)
        return view('administrador.Gestion_usuarios.edit', compact('usuario', 'roles'));

    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'roles' => ['array'],
            // Valida que los roles enviados existan
            'roles.*' => ['exists:roles,name'], // O 'exists:roles,id' si envías IDs
        ]);
        $usuario->update($request->all());

        // Sincroniza los roles del usuario usando Spatie.
        // `syncRoles` es el método ideal para actualizar un multi-select,
        // ya que elimina los roles que ya no están seleccionados y añade los nuevos.
        // Puedes pasarle nombres o IDs de roles.
        $usuario->syncRoles($request->input('roles', []));

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario desactivado exitosamente');
    }

    public function restore($id)
    {
        $usuario = User::withTrashed()->findOrFail($id);
        $usuario->restore();

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario reactivado exitosamente');
    }

    public function forceDelete($id)
    {
        $usuario = User::withTrashed()->findOrFail($id);
        $usuario->forceDelete();

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario eliminado permanentemente');
    }
}
