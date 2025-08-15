<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Subgrupo;
use App\Models\Estudiante;
use App\Models\Asistencia;

class AsistenciaController extends Controller
{
     //Muestra una lista de todos los grupos para que el instructor pueda seleccionar uno.
    public function seleccionarGrupo()
    {
        // Obtiene todos los registros de la tabla 'grupos'.
        $grupos = Grupo::all();

        // Retorna la vista y pasa la variable 'grupos' para que se pueda usar en ella.
        return view('instructor.asistencia.principal', compact('grupos'));
    }

    /**
     * Muestra los subgrupos de un grupo específico.
     */
    public function verSubgrupos($grupo_id)
    {
        // Busca un grupo por su ID. Si no lo encuentra, lanza una excepción 404.
        $grupo = Grupo::findOrFail($grupo_id);

        // Obtiene todos los subgrupos relacionados con el grupo.
        // El método `with('estudiantes')` carga de forma anticipada la relación de estudiantes
        // para evitar múltiples consultas a la base de datos (problema N+1).
        $subgrupos = $grupo->subgrupos()->with('estudiantes')->get();

        // Retorna la vista de subgrupos, pasando las variables 'grupo' y 'subgrupos'.
        return view('instructor.asistencia.subgrupos', compact('grupo', 'subgrupos'));
    }

    /**
     * Redirige a la página para tomar asistencia por grupo, utilizando el nombre.
     */
    public function tomarAsistenciaPorGrupo($nombre)
    {
        // Esta función es redundante si la ruta de `verSubgrupos` ya utiliza el ID del grupo.
        // Redirige a la ruta que muestra los subgrupos, pasando el nombre del grupo como parámetro.
        return redirect()->route('asistencia.subgrupos', ['grupo' => $nombre]);
    }

    /**
     * Muestra los estudiantes de un subgrupo para tomar asistencia.
     */
    public function tomarAsistenciaPorSubgrupo($id)
    {
        // Busca un subgrupo por su ID y carga sus estudiantes relacionados.
        $subgrupo = Subgrupo::with('estudiantes')->findOrFail($id);

        // Retorna la vista para tomar asistencia, pasando el subgrupo.
        return view('instructor.asistencia.tomar.subgrupo', compact('subgrupo'));
    }

    /**
     * Procesa y guarda la asistencia de los estudiantes.
     */
    public function guardar(Request $request)
    {
        // Obtiene los datos del formulario de la solicitud.
        $fecha = $request->input('fecha');
        $subgrupoId = $request->input('subgrupo_id');
        $asistencias = $request->input('asistencia');

        // Validación básica de los datos recibidos.
        if (!$fecha || !$subgrupoId) {
            return redirect()->back()->with('error', 'Faltan datos requeridos.');
        }

        if (!is_array($asistencias) || empty($asistencias)) {
            return redirect()->back()->with('error', 'No se recibieron datos de asistencia.');
        }

        // Itera sobre cada estudiante y su estado de asistencia.
        foreach ($asistencias as $documento => $estado) {
            if (!is_numeric($documento)) {
                continue; // Salta las claves que no son numéricas (por si acaso).
            }

            $documento = (int) $documento;

            try {
                // `firstOrNew` busca un registro existente con la misma fecha y documento de estudiante.
                // Si lo encuentra, lo actualiza. Si no, crea una nueva instancia del modelo.
                $asistencia = Asistencia::firstOrNew([
                    'estudiante_documento' => $documento,
                    'fecha' => $fecha
                ]);

                // Asigna los nuevos valores de la asistencia.
                $asistencia->subgrupo_id = $subgrupoId;
                $asistencia->estado = $estado;

                // Guarda o actualiza el registro en la base de datos.
                $asistencia->save();
            } catch (\Exception $e) {
                // Captura y maneja cualquier excepción que ocurra durante el guardado.
                return redirect()->back()->with('error', 'Error al guardar asistencia: ' . $e->getMessage());
            }
        }

        // Redirige de vuelta a la página anterior con un mensaje de éxito.
        return redirect()->back()->with('success', 'Asistencia guardada correctamente.');
    }

    /**
     * Muestra un reporte de asistencias con opciones de filtrado.
     */
    public function reporteAsistencias(Request $request)
    {
        // Inicia una consulta para el modelo Asistencia y carga las relaciones de 'estudiante' y 'subgrupo'.
        $query = Asistencia::with(['estudiante', 'subgrupo']);

        // Aplica un filtro si el usuario ha seleccionado un subgrupo.
        if ($request->filled('subgrupo')) {
            $query->where('subgrupo_id', $request->input('subgrupo'));
        }

        // Ordena los resultados por fecha de forma descendente y los obtiene.
        $asistencias = $query
            ->orderBy('fecha', 'desc')
            ->get()
            // Elimina registros duplicados basados en la combinación de estudiante, subgrupo y fecha.
            ->unique(fn($item) => $item->estudiante_documento . '_' . $item->subgrupo_id . '_' . $item->fecha);

        // Obtiene todos los subgrupos para el menú de filtrado en la vista.
        $subgrupos = Subgrupo::all();

        // Retorna la vista del reporte, pasando los datos de asistencias y subgrupos.
        return view('instructor.reporte.principal', compact('asistencias', 'subgrupos'));
    }
}
