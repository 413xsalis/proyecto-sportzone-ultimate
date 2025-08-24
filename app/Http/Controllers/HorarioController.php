<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::with(['instructor', 'grupo'])->get();
        return view('gestion_clases.horario', compact('horarios'));
        $instructores = Instructor::all();
        $grupos = Grupo::all();

        return view('colaborador.gestion_clases.principal', compact('horarios', 'instructores', 'grupos'));
    }

    public function mostrarPrincipal()
    {
        $horarios = Horario::with(['instructor', 'grupo'])->get();
        $instructores = Instructor::all();
        $grupos = Grupo::all();

        return view('colaborador.gestion_clases.principal', compact('horarios', 'instructores', 'grupos'));
    }

    public function create()
    {
        $instructores = Instructor::all();
        $grupos = Grupo::all();
        return view('colaborador.gestion_clases.crear', compact('instructores', 'grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'instructor_id' => 'required|exists:instructores,id',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        Horario::create($request->all());

        return redirect()->route('gestion_clases.principal')->with('success', 'Horario registrado exitosamente.');
    }

    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        $horarios = Horario::with(['instructor', 'grupo'])->get();
        $instructores = Instructor::all();
        $grupos = Grupo::all();
        $editar = true; // Indicador para saber que se está editando

    return view('colaborador.gestion_clases.principal', compact('horario', 'horarios', 'instructores', 'grupos', 'editar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'instructor_id' => 'required|exists:instructores,id',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        $horario = Horario::findOrFail($id);
        $horario->update($request->all());

        return redirect()->route('gestion_clases.principal')->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();

        return redirect()->route('gestion_clases.principal')->with('success', 'Horario eliminado correctamente.');
    }
}
