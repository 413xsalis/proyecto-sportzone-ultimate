<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Actividad;
use App\Models\Subgrupo;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;

class InstructorHorarioController extends Controller
{
    // Mostrar la vista con el calendario y datos necesarios
    public function horario()
    {
        $instructorId = 2;
        // $instructorId = Auth::user()->id; 

        $subgrupos = Subgrupo::all();
        $grupos = Grupo::all();

        $horarios = Horario::with(['grupo', 'instructor'])
            ->where('instructor_id', $instructorId)
            ->get();

        return view('instructor.horario.principal', compact('subgrupos', 'grupos', 'horarios'));
    }

    // Obtener actividades vía AJAX para el calendario
    public function obtenerActividades()
    {
        $actividades = Actividad::with(['horario.instructor', 'subgrupo', 'horario.grupo'])->get();

        $datos = $actividades->map(function ($a) {
            return [
                'id' => $a->id,
                'nombre' => $a->actividad,
                'horario_id' => $a->horario_id,
                'dia' => strtolower($a->horario->dia ?? ''),
                'hora' => $a->horario->hora_inicio ?? '',
                'hora_fin' => $a->horario->hora_fin ?? '',
                'grupo' => $a->horario->grupo->nombre ?? '',
                'subgrupo_id' => $a->subgrupo_id,
                'subgrupo' => $a->subgrupo->nombre ?? '',
                'instructor' => $a->horario->instructor->nombre ?? '',
                'especialidad' => $a->horario->instructor->especialidad ?? '',
                'estado' => $a->estado,
            ];
        });

        return response()->json($datos);
    }

    // Guardar nueva actividad (desde modal)
    public function guardarActividad(Request $request)
    {
        $request->validate([
            'horario_id' => 'required|exists:horarios,id',
            'actividad' => 'required|string|max:50',
        ]);

        try {
            // Obtener el horario y su subgrupo asociado
            $horario = Horario::with('grupo')->findOrFail($request->horario_id);

            // Crear la actividad con el subgrupo extraído del horario
            $actividad = Actividad::create([
                'horario_id' => $horario->id,
                'subgrupo_id' => $horario->grupo->id, // Aquí se asume que `grupo` es el subgrupo
                'actividad' => $request->actividad,
                'estado' => $request->estado,
            ]);

            return response()->json(['success' => true, 'actividad' => $actividad]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // Actualizar actividad existente
    public function actualizarActividad(Request $request, $id)
    {
        $actividad = Actividad::findOrFail($id);

        $actividad->update($request->only('actividad','estado'));

        return response()->json(['success' => true]);
    }

    // Eliminar actividad
    public function eliminarActividad($id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->delete();

        return response()->json(['success' => true]);
    }
}
