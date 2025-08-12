<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Subgrupo;
use App\Models\Estudiante;
use App\Models\Asistencia;

class AsistenciaController extends Controller
{
    // Mostrar todos los grupos disponibles
    public function seleccionarGrupo()
    {
        $grupos = Grupo::all();

        return view('instructor.asistencia.principal', compact('grupos'));
    }

    // Ver subgrupos de un grupo específico
    public function verSubgrupos($grupo_id)
    {
        $grupo = Grupo::findOrFail($grupo_id);
        $subgrupos = $grupo->subgrupos()->with('estudiantes')->get();

        return view('instructor.asistencia.subgrupos', compact('grupo', 'subgrupos'));
    }

    public function tomarAsistenciaPorGrupo($nombre)
    {
        // Redirige a la ruta que muestra los subgrupos del grupo seleccionado
        return redirect()->route('asistencia.subgrupos', ['grupo' => $nombre]);
    }

    // Mostrar estudiantes para tomar asistencia en un subgrupo
    public function tomarAsistenciaPorSubgrupo($id)
    {
        $subgrupo = Subgrupo::with('estudiantes')->findOrFail($id);

        return view('instructor.asistencia.tomar.subgrupo', compact('subgrupo'));
    }

    // Guardar la asistencia (por subgrupo)
    public function guardar(Request $request)
    {
        $fecha = $request->input('fecha');
        $subgrupoId = $request->input('subgrupo_id');
        $asistencias = $request->input('asistencia');

        // Validación básica
        if (!$fecha || !$subgrupoId) {
            return redirect()->back()->with('error', 'Faltan datos requeridos.');
        }

        if (!is_array($asistencias) || empty($asistencias)) {
            return redirect()->back()->with('error', 'No se recibieron datos de asistencia.');
        }

        foreach ($asistencias as $documento => $estado) {
            if (!is_numeric($documento)) {
                continue; // Evita claves no numéricas
            }

            $documento = (int) $documento;

            try {
                $asistencia = Asistencia::firstOrNew([
                    'estudiante_documento' => $documento,
                    'fecha' => $fecha
                ]);

                $asistencia->subgrupo_id = $subgrupoId;
                $asistencia->estado = $estado;
                $asistencia->save();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error al guardar asistencia: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Asistencia guardada correctamente.');
    }

    //REPORTES DE LAS ASISTENCIAS 
    public function reporteAsistencias(Request $request)
    {
        $query = Asistencia::with(['estudiante', 'subgrupo']);

        // Filtro por subgrupo si se selecciona
        if ($request->filled('subgrupo')) {
            $query->where('subgrupo_id', $request->input('subgrupo'));
        }

        // Traer todas las asistencias ordenadas por fecha
        $asistencias = $query
            ->orderBy('fecha', 'desc')
            ->get()
            // Agrupar para evitar fechas repetidas por estudiante + subgrupo + fecha
            ->unique(fn($item) => $item->estudiante_documento . '_' . $item->subgrupo_id . '_' . $item->fecha);

        $subgrupos = Subgrupo::all(); // para el select

        return view('instructor.reporte.principal', compact('asistencias', 'subgrupos'));
    }
}
