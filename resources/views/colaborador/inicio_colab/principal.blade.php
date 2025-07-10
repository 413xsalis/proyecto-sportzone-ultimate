@extends('colaborador.inicio_colab.layout')

@section('content')
<main class="content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Bienvenido</h1>
      <p>Módulo Colaborador</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <!-- <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
    </ul>
  </div>

  <!-- Sección Calendario y Asistencia -->
  <div class="row">
    <!-- Calendario -->
    <div class="col-md-6 mb-4">
      <label for="calendar" class="form-label">Selecciona una fecha:</label>
      <input type="date" class="form-control" id="calendar">
    </div>

    <!-- Asistencia semanal -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header asistencia-header">
          Asistencia Semanal
        </div>
        <div class="card-body" id="asistencia">
          <p>Sin datos por ahora.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Formulario de registro de instructor -->
  <div class="container mt-5">
    <h3>Registrar Nuevo Instructor</h3>
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('instructores.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="nombre" class="form-label">Nombres y Apellidos:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="documento" class="form-label">Documento:</label>
        <input type="text" name="documento" id="documento" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" class="form-control">
      </div>

      <div class="mb-3">
        <label for="especialidad" class="form-label">Especialidad:</label>
        <input type="text" name="especialidad" id="especialidad" class="form-control">
      </div>

      <button type="submit" class="btn btn-success">Registrar Instructor</button>
    </form>
  </div>

  <hr class="my-5">

<div class="container mt-4">
    <h3>Listado de Instructores Registrados</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($instructores->isEmpty())
        <p>No hay instructores registrados todavía.</p>
    @else

    <table class="table table-hover table-bordered text-center shadow-sm">
        <thead>
            <tr>
              <th><i class="bi bi-person-fill"></i> Nombre</th>
              <th><i class="bi bi-card-text"></i> Documento</th>
              <th><i class="bi bi-telephone-fill"></i> Teléfono</th>
              <th>Especialidad</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($instructores as $instructor)
            <tr>
                <td>{{ $instructor->nombre }}</td>
                <td>{{ $instructor->documento }}</td>
                <td>{{ $instructor->telefono }}</td>
                <td>{{ $instructor->especialidad }}</td>
                <td>
                {{-- Botón Editar --}}
            <a href="{{ route('instructores.edit', $instructor->id) }}" class="btn btn-sm btn-warning">
              <i class="bi bi-pencil-square"></i> Editar
              </a>
                {{-- Botón Eliminar --}}
                <form action="{{ route('instructores.destroy', $instructor->id) }}" method="POST" class="d-inline">
              @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este instructor?')">
              <i class="bi bi-trash"></i> Eliminar
                    </button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>


  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
</main>
@endsection
