@extends('colaborador.inscripcion_estudent.layout')
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
      <a href="{{ route('estudiantes.create') }}" class="btn btn-success">Nuevo Estudiante</a>
    </div>
    <br>

    <table class="table table-bordered">
      <tr>
        <th>Documento</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Nombre de Contacto</th>
        <th>Telefono de Contacto</th>
        <th>EPS</th>
        <th>Grupo/Nivel</th>
        <th>Acciones</th>
      </tr>
      </thead>
      @foreach ($estudiantes as $est)
        <tr>
          <td>{{ $est->documento }}</td>
          <td>{{ $est->nombre_1 }} {{ $est->apellido_1 }}</td>
          <td>{{ $est->telefono }}</td>
          <td>{{ $est->nombre_contacto}}</td>
          <td>{{ $est->telefono_contacto }}</td>
          <td>{{ $est->eps }}</td>
          <td>{{ $est->grupo ? $est->grupo->nombre : 'Sin grupo' }}</td>
        <td>

        <a href="{{ route('estudiante.edit', $est->documento) }}" class="btn btn-sm btn-warning">Editar</a>

        <form action="{{ route('estudiantes.destroy', $est->documento) }}" method="POST" style="display:inline-block;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger"
            onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
            Eliminar
          </button>
        </form>
        </td>
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