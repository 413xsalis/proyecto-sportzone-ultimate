@extends('colaborador.inicio_colab.layout')

@section('content')
  <main class="content">
    <div class="app-title">
    <h1><i class="bi bi-speedometer"></i> Bienvenido</h1>
    <p>Módulo Colaborador</p>
    </div>
    <div class="d-flex justify-content-between mb-1">
    <h2>Listado de Instructores Registrados</h2>
    <a href="{{ route('instructores.create') }}" class="btn btn-success">Nuevo Instructor</a>
    </div>
    <div class="container mt-4">
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
      <th><i class="bi bi-person-fill"></i> Nombres</th>
      <th><i class="bi bi-person-fill"></i> Apellidos</th>
      <th><i class="bi bi-card-text"></i> Documento</th>
      <th><i class="bi bi-telephone-fill"></i> Teléfono</th>
      <th><i class="bi bi-envelope-at-fill"></i> Correo Electrónico</th>
      
      <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
      @foreach($instructores as $instructor)
      <tr>
      <td>{{ $instructor->nombres }}</td>
      <td>{{ $instructor->apellidos}}</td>
      <td>{{ $instructor->documento }}</td>
      <td>{{ $instructor->telefono }}</td>
      <td>{{ $instructor->email }}</td>
      <td>
      {{-- Botón Editar --}}
      <a href="{{ route('instructores.edit', $instructor->id) }}" class="btn btn-sm btn-warning">
      <i class="bi bi-pencil-square"></i> Editar
      </a>
      {{-- Botón Eliminar --}}
      <form action="{{ route('instructores.destroy', $instructor->id) }}" method="POST" class="d-inline">
      @csrf
      @method('DELETE')
      <button class="btn btn-sm btn-danger"
      onclick="return confirm('¿Seguro que deseas eliminar este instructor?')">
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