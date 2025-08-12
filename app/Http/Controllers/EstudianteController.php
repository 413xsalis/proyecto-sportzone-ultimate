<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Http\Controllers\ColaboradorController;
use Illuminate\Validation\Rule;
class EstudianteController extends Controller
{


    public function index()
    {
        $estudiantes = Estudiante::all(); // Puedes usar paginación también
        return view('colaborador.inscripcion_estudent.principal', compact('estudiantes'));
    }

    public function create()
    {
        return view('colaborador.inscripcion_estudent.create'); // o la vista correcta si usas otra ruta
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|integer|unique:estudiantes,documento',
            'nombre_1' => 'required|string|max:255',
            'nombre_2' => 'required|string|max:255',
            'apellido_1' => 'required|string|max:255',
            'apellido_2' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'nombre_contacto' => 'nullable|string|max:255',
            'telefono_contacto' => 'nullable|string|max:20',
            'eps' => 'nullable|string|max:255',
            'id_grupo_nivel' => 'nullable|integer',
        ]);

        Estudiante::create($request->only([
            'documento',
            'nombre_1',
            'nombre_2',
            'apellido_1',
            'apellido_2',
            'telefono',
            'nombre_contacto',
            'telefono_contacto',
            'eps',
            'id_grupo_nivel'
        ]));


        //Estudiante::create($request->all());
        return redirect()->route('colab.inscripcion')
            ->with('success', 'Usuario creado exitosamente.');

    }

    // public function listado()
    // {
    //     $estudiantes = Estudiante::all();
    //     return view('colaborador.inscripcion_estudent.listado', compact('estudiantes'));
    // }

    // public function edit($id)
    // {
    //     $estudiante = Estudiante::findOrFail($id);
    //     return view('colaborador.inscripcion_estudent.edit', compact('estudiante'));
    // }


     public function edit( Estudiante $estudiante)
    {
        return view('colaborador.inscripcion_estudent.editar', compact('estudiante'));
    }


    // public function update(Request $request,Estudiante $id)
    // {
    //     $estudiante = Estudiante::findOrFail($id);
    //     $estudiante->update($request->all());

    //     return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente.');
    // }
public function update(Request $request, Estudiante $estudiante)
{
    $validated = $request->validate([
        'documento' => [
            'required',
            'integer',
            Rule::unique('estudiantes')->ignore($estudiante->documento, 'documento'),
        ],
        
        'nombre_1' => 'required|string|max:255',
        'nombre_2' => 'nullable|string|max:255',
        'apellido_1' => 'required|string|max:255',
        'apellido_2' => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'nombre_contacto' => 'nullable|string|max:255',
        'telefono_contacto' => 'nullable|string|max:20',
        'eps' => 'nullable|string|max:255',
        // 'id_grupo_nivel' => 'nullable|integer|exists:grupos_niveles,id',
    ]);

    $estudiante->update($validated);

    return redirect()->route('colab.inscripcion')
        ->with('success', 'Estudiante actualizado');
}
//    public function update(Request $request, Estudiante $estudiante)
// {
//     $request->validate([
//         // Validación para el documento (único, pero ignorando el registro actual)
//         'documento' => [
//             'required',
//             'integer',
//             Rule::unique('estudiantes')->ignore($estudiante->documento, 'documento'),
//         ],
//         'nombre_1' => 'required|string|max:255',
//         'nombre_2' => 'nullable|string|max:255',
//         'apellido_1' => 'required|string|max:255',
//         'apellido_2' => 'nullable|string|max:255',
//         'telefono' => 'nullable|string|max:20',
//         'nombre_contacto' => 'nullable|string|max:255',
//         'telefono_contacto' => 'nullable|string|max:20',
//         'eps' => 'nullable|string|max:255',
//         'id_grupo_nivel' => 'nullable|integer|exists:grupos_niveles,id', // Si existe relación
//     ]);

//     $estudiante->update($request->only([
//         'documento',
//         'nombre_1',
//         'nombre_2',
//         'apellido_1',
//         'apellido_2',
//         'telefono',
//         'nombre_contacto',
//         'telefono_contacto',
//         'eps',
//         'id_grupo_nivel'
//     ]));

//     return redirect()->route('colab.inscripcion')
//         ->with('success', 'Estudiante actualizado exitosamente.');
// }


    // public function destroy($id)
    // {
    //     $estudiante = Estudiante::findOrFail($id);
    //     $estudiante->delete();

    //     return redirect()->back()->with('success', 'Estudiante eliminado correctamente.');
    // }

        public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();

        return redirect()->route('colab.inscripcion')
            ->with('success', 'Usuario eliminado exitosamente');
    }

}
