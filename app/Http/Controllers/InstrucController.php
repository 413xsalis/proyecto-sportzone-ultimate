<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class InstrucController extends Controller
{
    public function index()
    {
        return view('instructor.inicio.principal');
    }

    public function principal()
    {
        return view('instructor.inicio.principal');
    }

    public function horario()
    {
        return view('instructor.horario.principal');
    }

    public function asistencia()
    {
        return view('instructor.asistencia.principal');
    }
    
    public function perfil()
    {
        $instructor = Auth::user();
        return view('instructor.perfil', compact('instructor'));
    }
    
    public function actualizarPerfil(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'documento_identidad' => 'required|unique:users,documento_identidad,' . $user->id,
            'telefono' => 'nullable|string|max:20',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->all();
        
        // Procesar imagen de perfil si se subió
        if ($request->hasFile('foto_perfil')) {
            if ($user->foto_perfil && Storage::disk('public')->exists($user->foto_perfil)) {
                Storage::disk('public')->delete($user->foto_perfil);
            }
            
            $imagePath = $request->file('foto_perfil')->store('perfiles', 'public');
            $data['foto_perfil'] = $imagePath;
        }
        
        $user->update($data);
        
        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }
}