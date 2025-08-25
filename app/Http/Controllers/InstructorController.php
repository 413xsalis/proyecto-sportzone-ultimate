<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Instructor;

class InstructorController extends Controller
{
    public function principal()
    {
        return view('instructor.inicio.principal');
    }

    public function horario()
    {
        return view('instructor.horarios.principal');
    }

    public function create()
    {
        return view('colaborador.inicio_colab.create'); // o la vista correcta si usas otra ruta
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'documento' => 'required|unique:instructores,documento',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:instructores,email',
        ]);

        Instructor::create($request->all());

        return redirect()->route('colab.principal')
            ->with('success', 'Instructor creado exitosamente.');
    }

    public function index()
    {
        $instructores = Instructor::all();
        return view('colaborador.inicio_colab.principal', compact('instructores'));
    }

    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);
        return view('colaborador.inicio_colab.editar', compact('instructor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'documento' => 'required|string|max:25',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $instructor = Instructor::findOrFail($id);
        $instructor->update($request->all());

        return redirect()->route('colab.principal')->with('success', 'Instructor actualizado correctamente.');
    }

    public function destroy($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();

        return redirect()->back()->with('success', 'Instructor eliminado correctamente.');
    }


}