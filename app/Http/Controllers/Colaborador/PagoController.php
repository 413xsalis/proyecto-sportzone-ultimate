<?php

namespace App\Http\Controllers\Colaborador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Estudiante;


class PagoController extends Controller
{
    // Vista principal del módulo de pagos
    public function index()
    {
        return view('colaborador.pagos.principal');
    }

    // Mostrar formulario y lista de pagos de inscripción
    public function inscripciones()
    {
         $pagos = Pago::with('estudiante')->where('tipo', 'inscripción')->get();
         $estudiantes = Estudiante::all();
         
        return view('colaborador.pagos.inscripciones', compact('pagos', 'estudiantes'));
    }

    // Guardar un nuevo pago de inscripción
    public function storeInscripcion(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:inscripción',
            'valor' => 'required|numeric',
            'fecha_pago' => 'required|date',
            'medio_pago' => 'required|in:efectivo,nequi,daviplata,transferencia',
            'estudiante_documento' => 'required|exists:estudiantes,documento',
        ], [
            'valor.min' => 'El valor debe ser mayor a 1000 pesos.',
            'medio_pago.in' => 'El medio de pago seleccionado no es válido.',
            'estudiante_documento.exists' => 'El estudiante no existe en la base de datos.'
        ]);
        // Verificar si ya existe un pago de inscripción para el estudiante
         $existePago = Pago::where('tipo', 'inscripción')
        ->where('estudiante_documento', $request->estudiante_documento)
        ->exists();

        if ($existePago) {
        return redirect()->back()->withErrors(['estudiante_documento' => 'Este estudiante ya tiene un pago de inscripción registrado.'])->withInput();
        }
        // Crear el pago de inscripción
        Pago::create([
            'tipo' => 'inscripción',
            'valor' => $request->valor,
            'fecha_pago' => $request->fecha_pago,
            'medio_pago' => $request->medio_pago,
            'estado' => 'Pagado', // Por defecto, una inscripción se paga completa
            'estudiante_documento' => $request->estudiante_documento,
        ]);

        return redirect()->route('pagos.inscripciones.index')->with('success', 'Pago de inscripción registrado correctamente');
    }

    // Vista de mensualidades (la desarrollamos después)

    public function mensualidades()
{
    $estudiantes = Estudiante::all();
    $pagos = Pago::with('estudiante')->where('tipo', 'mensualidad')->get(); // Para mostrar en el select

    return view('colaborador.pagos.mensualidades', compact('estudiantes', 'pagos'));
}

public function storeMensualidad(Request $request)
{
    $request->validate([
        'tipo' => 'required|in:mensualidad',
        'valor' => 'required|numeric',
        'fecha_pago' => 'required|date',
        'medio_pago' => 'required|in:efectivo,nequi,daviplata,transferencia',
        'estudiante_documento' => 'required|exists:estudiantes,documento',
    ], [
        'valor.min' => 'El valor debe ser mayor a 1000 pesos.',
        'medio_pago.in' => 'El medio de pago seleccionado no es válido.',
        'estudiante_documento.exists' => 'El estudiante no existe en la base de datos.'
    ]);

    Pago::create([
        'tipo' => 'mensualidad',
        'concepto' => $request->concepto,
        'valor' => $request->valor,
        'fecha_pago' => $request->fecha_pago,
        'medio_pago' => $request->medio_pago,
        'estado' => 'Pagado',
        'estudiante_documento' => $request->estudiante_documento,
    ]);

    return redirect()->route('pagos.mensualidades')->with('success', 'Pago de mensualidad registrado correctamente');
}

// Mostrar formulario de edición
public function edit($id)
{
    $pago = Pago::findOrFail($id);
    $estudiantes = Estudiante::all();

    return view('colaborador.pagos.editar', compact('pago', 'estudiantes'));
}

  /**
     * Actualizar el pago en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);

        $request->validate([
            'valor' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
            'medio_pago' => 'required|string',
            'estado' => 'required|string',
            'estudiante_documento' => 'required|exists:estudiantes,documento',
        ]);

        $pago->update([
            'concepto' => $request->concepto,
            'valor' => $request->valor,
            'fecha_pago' => $request->fecha_pago,
            'medio_pago' => $request->medio_pago,
            'estado' => $request->estado,
            'estudiante_documento' => $request->estudiante_documento,
        ]);

        return redirect()->route('pagos.pagos.index')->with('success', 'El pago fue actualizado correctamente.');
    }

// Eliminar un pago
public function destroy($id)
{
    $pago = Pago::findOrFail($id);
    $pago->delete();

    return redirect()->back()->with('success', 'Pago eliminado correctamente');
}




}