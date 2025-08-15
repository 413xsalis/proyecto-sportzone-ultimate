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
    /**
     * Muestra la vista principal del horario del instructor, cargando los datos iniciales.
     */
    public function horario()
    {
        // NOTA: El ID del instructor está codificado aquí (ID = 2). 
        // Cambiar a: Auth::user()->id
        $instructorId = 2;

        // Obtiene todos los subgrupos y grupos disponibles.
        // Estos datos se usarán en el menú desplegable del modal para asignar actividades.
        $subgrupos = Subgrupo::all();
        $grupos = Grupo::all();

        // Obtiene todos los horarios asociados a este instructor.
        // El método `with()` carga de forma anticipada las relaciones de 'grupo' e 'instructor'
        // para evitar múltiples consultas a la base de datos (problema N+1).
        $horarios = Horario::with(['grupo', 'instructor'])
            ->where('instructor_id', $instructorId)
            ->get();

        // Retorna la vista principal del horario, pasando los datos necesarios.
        return view('instructor.horario.principal', compact('subgrupos', 'grupos', 'horarios'));
    }

    /**
     * Obtiene y formatea las actividades del horario para ser consumidas por el calendario vía AJAX.
     */
    public function obtenerActividades()
    {
        // Obtiene todas las actividades y carga las relaciones anidadas (`horario`, `subgrupo`, etc.).
        $actividades = Actividad::with(['horario.instructor', 'subgrupo', 'horario.grupo'])->get();

        // Transforma la colección de actividades a un formato JSON específico para el front-end.
        $datos = $actividades->map(function ($a) {
            return [
                'id' => $a->id,
                'nombre' => $a->actividad,
                'horario_id' => $a->horario_id,
                'dia' => strtolower($a->horario->dia ?? ''), // Obtiene el día y lo convierte a minúsculas.
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

        // Devuelve los datos como una respuesta JSON.
        return response()->json($datos);
    }

    /**
     * Guarda una nueva actividad en el horario.
     */
    public function guardarActividad(Request $request)
    {
        // 1. Valida los datos recibidos del formulario del modal.
        $request->validate([
            'horario_id' => 'required|exists:horarios,id', // Debe existir un horario con este ID.
            'subgrupo_id' => 'required|exists:subgrupos,id', // Debe existir un subgrupo con este ID.
            'actividad' => 'required|string|max:50',
            'estado' => 'required|string|in:pendiente,activo,cancelado', // El estado debe ser uno de estos valores.
        ]);

        try {
            // 2. Crea y guarda la nueva actividad en la base de datos.
            $actividad = Actividad::create([
                'horario_id' => $request->horario_id,
                'subgrupo_id' => $request->subgrupo_id,
                'actividad' => $request->actividad,
                'estado' => $request->estado,
            ]);

            // 3. Obtiene el subgrupo y el horario relacionados para la respuesta.
            $subgrupo = Subgrupo::find($request->subgrupo_id);
            $horario = Horario::find($request->horario_id);

            // 4. Retorna una respuesta JSON para que el front-end sepa que la operación fue exitosa
            // y tenga los datos para actualizar la interfaz sin recargar.
            return response()->json([
                'success' => true,
                'id' => $actividad->id,
                'subgrupo_nombre' => $subgrupo->nombre,
                'hora_inicio' => substr($horario->hora_inicio, 0, 5),
                'hora_fin' => substr($horario->hora_fin, 0, 5)
            ]);
        } catch (\Exception $e) {
            // Maneja cualquier error que pueda ocurrir y devuelve un mensaje de error.
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Actualiza una actividad existente.
     */
    public function actualizarActividad(Request $request, $id)
    {
        // Busca la actividad por su ID. Si no la encuentra, lanza un error 404.
        $actividad = Actividad::findOrFail($id);

        // Actualiza solo los campos 'actividad' y 'estado' con los datos del request.
        $actividad->update($request->only('actividad', 'estado'));

        // Devuelve una respuesta JSON simple de éxito.
        return response()->json(['success' => true]);
    }

    /**
     * Elimina una actividad del horario.
     */
    public function eliminarActividad($id)
    {
        // Busca la actividad por su ID y la elimina.
        $actividad = Actividad::findOrFail($id);
        $actividad->delete();

        // Devuelve una respuesta JSON de éxito.
        return response()->json(['success' => true]);
    }
}
