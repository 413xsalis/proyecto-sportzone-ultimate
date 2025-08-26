@extends('colaborador.gestion_clases.layout')

@section('title', 'Gestión de Clases')

@section('content')


  <main class="content">
    <div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Inscripcion de Estudiantes </h1>
      <p> Modulo Colaborador</p>
    </div>
    </div>
    <div class="d-flex justify-content-between mb-1">
      <h2>Lista de Estudiantes Registrados</h2>
      <a href="{{ route('horarios.create') }}" class="btn btn-success">Nuevo Horario</a>
    </div>
    <br>

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

    </table>

    </div>


    <style>
    .fade.collapse:not(.show) {
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .fade.collapse.show {
      opacity: 1;
      transition: opacity 0.5s ease;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
      const btn = document.getElementById('toggleListaBtn');
      const collapse = document.getElementById('listadoEstudiantes');

      collapse.addEventListener('show.bs.collapse', function () {
      btn.textContent = 'Ocultar Lista de Estudiantes Inscritos';
      });

      collapse.addEventListener('hide.bs.collapse', function () {
      btn.textContent = 'Ver Lista de Estudiantes Inscritos';
      });
    });
    </script>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
  </main>
@endsection