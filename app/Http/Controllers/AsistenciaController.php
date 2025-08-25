<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function guardar(Request $request)
    {
        // Validación
        $request->validate([
            'fecha' => 'required|date',
            'nombre_grupo' => 'required|exists:grupos,nombre',
            'asistencia' => 'required|array',
        ]);

        // Extraer datos del request
        $fecha = $request->input('fecha');
        $nombreGrupo = $request->input('nombre_grupo');
        $asistencias = $request->input('asistencia');

        // Obtener el grupo por su nombre
        $grupo = Grupo::where('nombre', $nombreGrupo)->firstOrFail();

        // Guardar o actualizar asistencia
        foreach ($asistencias as $documento => $estado) {
            \App\Models\Asistencia::updateOrCreate(
                [
                    'fecha' => $fecha,
                    'documento_estudiante' => $documento,
                ],
                [
                    'id_grupo' => $grupo->nombre,  // Si `nombre` es la PK
                    'estado' => $estado,
                ]
            );
        }

        return redirect()->back()->with('success', 'Asistencia guardada correctamente.');
    }


    public function seleccionarGrupo()
    {
        $grupos = Grupo::all();

        if ($grupos->isEmpty()) {
            return view('instructor.asistencia.principal', [
                'grupos' => $grupos,
                'error' => 'No hay grupos disponibles',
            ]);
        }

        return view('instructor.asistencia.principal', compact('grupos'));
    }


    public function tomarAsistencia($nombre)
    {
        $grupo = Grupo::where('nombre', $nombre)->firstOrFail();

        $grupoNivel = \App\Models\GrupoNivel::where('id_grupo_nivel', $grupo->id_grupo_nivel)->firstOrFail();

        // Traer estudiantes cuyo documento coincida con el del grupo (según tu estructura)
        $estudiantes = \App\Models\Estudiante::where('documento', $grupo->documento)->get();

        return view('instructor.asistencia.tomar', compact('grupo', 'grupoNivel', 'estudiantes')); //colocar la S en grupo --- PENDIENTE
    }
}
