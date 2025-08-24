<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PerfilAdminController extends Controller
{
    public function edit()
    {
        return view('administrador.admin.perfiladmin');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'documento_identidad' => 'required|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:15',
            'eps' => 'nullable|string|max:100',
            'direccion_hogar' => 'nullable|string|max:500',
        ]);

        $user->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'foto_documento' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Eliminar documento anterior si existe
        if ($user->foto_documento) {
            Storage::delete($user->foto_documento);
        }

        // Guardar nuevo documento
        $path = $request->file('foto_documento')->store('documentos', 'public');
        $user->foto_documento = $path;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Documento subido correctamente.');
    }

    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        $user = Auth::user();

        // Guardar logo
        $path = $request->file('logo')->store('logos', 'public');

        if ($request->has('use_as_profile')) {
            // Eliminar foto de perfil anterior si existe
            if ($user->foto_perfil) {
                Storage::delete($user->foto_perfil);
            }
            $user->foto_perfil = $path;
        }

        $user->logo_personalizado = $path;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Logo actualizado correctamente.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Contraseña cambiada correctamente.');
    }
}

