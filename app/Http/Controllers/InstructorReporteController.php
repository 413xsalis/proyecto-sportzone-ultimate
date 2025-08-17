<?php

namespace App\Http\Controllers;

use App\Models\Subgrupo;
use App\Models\Asistencia; 
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InstructorReporteController extends Controller
{
    // Método 1: Muestra la vista del reporte con los filtros
    public function mostrarReporte(Request $request)
    {
        // Obtiene todos los subgrupos para poblar el filtro
        $subgrupos = Subgrupo::all();

        // Inicializa la variable de asistencias como una colección vacía
        $asistencias = collect();

        // Si el usuario ha seleccionado un subgrupo, filtra y obtiene los datos
        if ($request->has('subgrupo_id')) {
            $subgrupoId = $request->input('subgrupo_id');
            $asistencias = Asistencia::where('subgrupo_id', $subgrupoId)
                ->with(['estudiante', 'subgrupo.grupo'])
                ->get();
        }

        // Retorna la vista con los datos del filtro y las asistencias
        return view('instructor.reportes.asistencias', compact('subgrupos', 'asistencias'));
    }

    // Método 2: Genera el reporte en PDF
    public function generarAsistenciasPDF(Request $request)
    {
        // Valida que el ID del subgrupo esté presente en el request
        $request->validate([
            'subgrupo_id' => 'required|exists:subgrupos,id'
        ]);

        $subgrupoId = $request->input('subgrupo_id');

        // Obtiene los datos de asistencia para el PDF
        $asistencias = Asistencia::where('subgrupo_id', $subgrupoId)
            ->with(['estudiante', 'subgrupo.grupo'])
            ->get();

        // Carga la vista Blade específica para el PDF
        $pdf = Pdf::loadView('instructor.reportes.asistencias_pdf', compact('asistencias'));

        // Retorna el PDF para que se muestre en el navegador
        return $pdf->stream('reporte_asistencias.pdf');
    }
}
