@extends('colaborador.inicio_colab.layout')

@section('content')
<main class="app-content">
  <div class="app-title">
    <h1>Editar Instructor</h1>
  </div>

  <div class="container mt-4">
    <form action="{{ route('instructores.update', $instructor->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Nombre:</label>
        <input type="text" name="nombre" class="form-control" value="{{ $instructor->nombre }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Documento:</label>
        <input type="text" name="documento" class="form-control" value="{{ $instructor->documento }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Teléfono:</label>
        <input type="text" name="telefono" class="form-control" value="{{ $instructor->telefono }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Especialidad:</label>
        <input type="text" name="especialidad" class="form-control" value="{{ $instructor->especialidad }}" required>
      </div>

      <button type="submit" class="btn btn-success">
        <i class="bi bi-save"></i> Guardar Cambios
      </button>

      <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Cancelar
      </a>
    </form>
  </div>
</main>
@endsection
