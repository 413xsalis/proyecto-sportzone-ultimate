@extends('colaborador.gestion_clases.layout')

@section('title', 'Gestión de Clases')

@section('content')
 @extends('layouts.app') {{-- Usa tu layout base --}}

<div class="container">
    <h1 class="mb-4">Lista de Horarios</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Día</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Instructor</th>
                <th>Grupo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $horario)
                <tr>
                    <td>{{ $horario->dia }}</td>
                    <td>{{ $horario->fecha }}</td>
                    <td>{{ $horario->hora_inicio }}</td>
                    <td>{{ $horario->hora_fin }}</td>
                    <td>{{ $horario->instructor->name ?? 'Sin instructor' }}</td>
                    <td>{{ $horario->grupo->nombre ?? 'Sin grupo' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
@endsection