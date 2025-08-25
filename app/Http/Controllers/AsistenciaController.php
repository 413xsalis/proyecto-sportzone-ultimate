<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Subgrupo;
use App\Models\Estudiante;
use App\Models\Asistencia;
use Carbon\Carbon;


class AsistenciaController extends Controller
{
    public function asistencia()
    {
        return view('instructor.asistencia.principal');
    }
    
    // Muestra una lista de todos los grupos para que el instructor pueda seleccionar uno.
    public function seleccionarGrupo()
    {
        $grupos = Grupo::all();
        return view('instructor.asistencia.principal', compact('grupos'));
    }

    // Muestra los subgrupos de un grupo específico.
    public function verSubgrupos($grupo_id)
    {
        $grupo = Grupo::findOrFail($grupo_id);
        $subgrupos = $grupo->subgrupos()->with('estudiantes')->get();
        return view('instructor.asistencia.subgrupos', compact('grupo', 'subgrupos'));
    }

    // Redirige a la página para tomar asistencia por grupo. (Esta función es redundante pero la mantenemos).
    public function tomarAsistenciaPorGrupo($nombre)
    {
        return redirect()->route('asistencia.subgrupos', ['grupo' => $nombre]);
    }

    // **MÉTODO CORREGIDO:** Muestra los estudiantes de un subgrupo para tomar asistencia.
    public function tomarAsistenciaPorSubgrupo($id)
    {
        $subgrupo = Subgrupo::with('estudiantes')->findOrFail($id);
        return view('instructor.asistencia.tomar.subgrupo', compact('subgrupo'));
    }

    // Procesa y guarda la asistencia de los estudiantes. (Mejora con updateOrCreate)
    public function guardar(Request $request)
    {
        $request->validate([
            'subgrupo_id' => 'required|exists:subgrupos,id',
            'fecha' => 'required|date',
            'asistencia' => 'required|array',
            'asistencia.*' => 'required|in:presente,ausente,justificado'
        ]);

        $subgrupoId = $request->input('subgrupo_id');
        $fecha = $request->input('fecha');
        $asistencias = $request->input('asistencia');

        foreach ($asistencias as $documento => $estado) {
            try {
                Asistencia::updateOrCreate(
                    [
                        'estudiante_documento' => $documento,
                        'fecha' => $fecha,
                    ],
                    [
                        'subgrupo_id' => $subgrupoId,
                        'estado' => $estado,
                    ]
                );
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error al guardar asistencia: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Asistencia guardada correctamente.');
    }

    // Muestra un reporte de asistencias con opciones de filtrado. (Mejora en la consulta)
    public function reporteAsistencias(Request $request)
    {
        $query = Asistencia::with(['estudiante', 'subgrupo']);

        if ($request->filled('subgrupo')) {
            $query->where('subgrupo_id', $request->input('subgrupo'));
        }

        $asistencias = $query
            ->orderBy('fecha', 'desc')
            ->get();

        $subgrupos = Subgrupo::all();

        return view('instructor.reporte.principal', compact('asistencias', 'subgrupos'));
    }

    // **NUEVA FUNCIÓN:** Muestra los eventos y asistencias de un día específico para el dashboard.
    public function eventosDelDia($fecha = null)
    {
        $fecha = $fecha ? Carbon::parse($fecha) : Carbon::today();

        $asistenciasHoy = Asistencia::whereDate('fecha', $fecha)
            ->with(['estudiante', 'subgrupo'])
            ->get();
        
        return view('instructor.dashboard.notificaciones', compact('asistenciasHoy'));
    }
}