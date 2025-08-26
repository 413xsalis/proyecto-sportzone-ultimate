<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    // Mostrar todos los horarios
    public function index()
    {
        $horarios = Horario::with(['instructor', 'grupo'])->get();
        return view('colaborador.gestion_clases.principal', compact('horarios'));
    }


    public function create()
    {
        $instructores = User::role('instructor')->get(); // Solo usuarios con rol instructor
        $grupos = Grupo::all(); // Todos los grupos

        return view('colaborador.gestion_clases.create', compact('instructores', 'grupos'));
    }

    // Formulario de creación
    public function store(Request $request)
    {
        $request->validate([
            'instructor_id' => 'required|exists:users,id',
            'grupo_id' => 'required|exists:grupos,id',
            'dia' => 'required|string',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        Horario::create([
            'instructor_id' => $request->instructor_id,
            'grupo_id' => $request->grupo_id,
            'dia' => $request->dia,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);
        return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente');
    }

    // Mostrar un horario específico
    public function show(Horario $horario)
    {
        return view('horarios.show', compact('horario'));
    }

    // Formulario de edición
    public function edit(Horario $horario)
    {
        $instructores = User::role('instructor')->get();
        $grupos = Grupo::all();
        return view('horarios.edit', compact('horario', 'instructores', 'grupos'));
    }

    // Actualizar horario
    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'instructor_id' => 'required|exists:users,id',
            'grupo_id' => 'required|exists:grupos,id',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $horario->update($request->all());

        return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente');
    }

    // Eliminar horario
    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado correctamente');
    }
}