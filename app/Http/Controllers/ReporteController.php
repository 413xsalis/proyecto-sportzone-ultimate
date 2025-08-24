<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Pago;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PagosExports;

class ReporteController extends Controller
{
    public function reporteInscripciones(Request $request)
    {
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;

        $estudiantes = Estudiante::whereBetween('created_at', [$fechaInicio, $fechaFin])->get();

        $pdf = Pdf::loadView('colaborador.reportes.pdf', compact('estudiantes', 'fechaInicio', 'fechaFin'));

        return $pdf->stream('reporte_inscripciones.pdf');
    }

     // 📌 Reporte de Pagos en PDF
    public function pagosPDF(Request $request)
    {
        $tipo = $request->tipo;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;

        $query = Pago::query();

        if ($tipo) {
            $query->where('tipo', $tipo);
        }
        if ($inicio && $fin) {
            $query->whereBetween('fecha_pago', [$inicio, $fin]);
        }

        $pagos = $query->get();

        $pdf = Pdf::loadView('colaborador.reportes.pagos', compact('pagos', 'inicio', 'fin', 'tipo'));
        return $pdf->download('reporte_pagos.pdf');
    }

    // Reporte de Pagos en Excel
    public function pagosExcel(Request $request)
    {
        $tipo = $request->tipo;
        $inicio = $request->fecha_inicio;
        $fin = $request->fecha_fin;

        return Excel::download(new PagosExports($tipo, $inicio, $fin), 'reporte_pagos.xlsx');
    }


}

    




