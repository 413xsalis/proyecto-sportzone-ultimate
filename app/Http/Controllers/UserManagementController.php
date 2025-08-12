<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroUsuarioMail;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|exists:roles,name',
        ]);

        $plainPassword = Str::random(10);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($plainPassword),
        ]);

        $user->assignRole($request->role);

        Mail::to($user->email)->send(new RegistroUsuarioMail($user, $plainPassword));

        return redirect()->back()->with('success', 'Usuario creado correctamente y credenciales enviadas.');
    }
}
