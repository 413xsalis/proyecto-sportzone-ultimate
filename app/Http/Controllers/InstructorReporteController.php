<?php

namespace App\Http\Controllers;

use App\Models\Subgrupo;
use App\Models\Grupo;
use App\Models\Asistencia;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon; 
use Illuminate\Http\Request;

class InstructorReporteController extends Controller
{
    public function reporte()
    {
        return view('instructor.reporte.principal');
    }
    
    public function mostrarReporte(Request $request)
    {
        $grupos = Grupo::all();
        $asistencias = collect();

        if ($request->has('subgrupo_id') && $request->has('fecha')) {
            $subgrupoId = $request->input('subgrupo_id');
            $fecha = $request->input('fecha');
            $asistencias = Asistencia::where('subgrupo_id', $subgrupoId)
                ->where('fecha', $fecha)
                ->with(['estudiante', 'subgrupo.grupo'])
                ->get();
        }

        return view('instructor.reporte.principal', compact('grupos', 'asistencias'));
    }

    public function generarAsistenciasPDF(Request $request)
    {
        // Valida que el ID del subgrupo y la fecha estén presentes
        $request->validate([
            'subgrupo_id' => 'required|exists:subgrupos,id',
            'fecha' => 'required|date'
        ]);

        $subgrupoId = $request->input('subgrupo_id');
        $fecha = $request->input('fecha');
        $fechaGeneracion = Carbon::now()->format('d-m-Y'); // Obtiene la fecha y hora actuales

        // Obtiene los datos de asistencia para el PDF filtrando también por la fecha
        $asistencias = Asistencia::where('subgrupo_id', $subgrupoId)
            ->where('fecha', $fecha)
            ->with(['estudiante', 'subgrupo.grupo'])
            ->get();

        // Pasa la fecha de generación a la vista del PDF
        $pdf = Pdf::loadView('instructor.reporte.asistencias_pdf', compact('asistencias', 'fechaGeneracion'));

        return $pdf->stream('reporte_asistencias.pdf');
    }

    public function getSubgrupos($grupoId)
    {
        $subgrupos = Subgrupo::where('grupo_id', $grupoId)->get();
        return response()->json($subgrupos);
    }
}
