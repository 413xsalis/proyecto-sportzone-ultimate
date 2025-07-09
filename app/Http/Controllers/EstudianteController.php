<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;


class EstudianteController extends Controller
{
    public function create()
    {
        return view('estudiantes.create'); // o la vista correcta si usas otra ruta
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento'          => 'required|integer|unique:estudiantes,documento',
            'nombre_1'           => 'required|string|max:255',
            'nombre_2'           => 'required|string|max:255',
            'apellido_1'         => 'required|string|max:255', 
            'apellido_2'         => 'required|string|max:255',
            'telefono'           => 'nullable|string|max:20',
            'nombre_contacto'    => 'nullable|string|max:255',
            'telefono_contacto'  => 'nullable|string|max:20',
            'eps'                => 'nullable|string|max:255',
            'id_grupo_nivel'     => 'nullable|integer',
        ]);

        Estudiante::create($request->only([
        'documento', 'nombre_1', 'nombre_2', 'apellido_1', 'apellido_2',
        'telefono', 'nombre_contacto', 'telefono_contacto', 'eps', 'id_grupo_nivel'
        ]));


        //Estudiante::create($request->all());
return redirect()->back()->with([
    'success' => 'Estudiante inscrito correctamente.',
    'mostrar_lista' => true
]);

    }

    public function index()
{
    $estudiantes = Estudiante::all(); // Puedes usar paginación también
    return view('colaborador.inscripcion_estudent.index', compact('estudiantes'));
}

    public function listado()
{
    $estudiantes = Estudiante::all();
    return view('colaborador.inscripcion_estudent.listado', compact('estudiantes'));
}

public function edit($id)
{
    $estudiante = Estudiante::findOrFail($id);
    return view('colaborador.inscripcion_estudent.edit', compact('estudiante'));
}

public function update(Request $request, $id)
{
    $estudiante = Estudiante::findOrFail($id);
    $estudiante->update($request->all());

    return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente.');
}

public function destroy($id)
{
   $estudiante = Estudiante::findOrFail($id);
    $estudiante->delete();

    return redirect()->back()->with('success', 'Estudiante eliminado correctamente.');
}

}
