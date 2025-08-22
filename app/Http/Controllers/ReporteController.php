<?php

// app/Http/Controllers/ReporteController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function reporteInscripciones(Request $request)
    {
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;

        $estudiantes = Estudiante::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();

        $pdf = Pdf::loadView('colaborador.reportes.pdf', compact('estudiantes', 'fechaInicio', 'fechaFin'));

        //return response($pdf->output(), 200)
        //->header('Content-Type', 'application/pdf')
        //->header('Content-Disposition', 'inline; filename="reporte_inscripciones.pdf"');

        // ⬇️ Mostrar en navegador en vez de descargar
        return $pdf->stream('reporte_inscripciones.pdf');
    }   
}
