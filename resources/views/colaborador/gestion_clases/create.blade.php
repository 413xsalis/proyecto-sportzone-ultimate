@extends('colaborador.gestion_clases.layout')

@section('title', 'Gestión de Clases')

@section('content')
  <div class="container">
    <h2 class="mb-4">Crear Horario de Clases</h2>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Formulario para crear un horario --}}
    <form action="{{ route('horarios.store') }}" method="POST">
      @csrf

      {{-- Seleccionar Instructor --}}
      <div class="mb-3">
        <label for="instructor_id" class="form-label">Instructor</label>
        <select name="instructor_id" id="instructor_id" class="form-select" required>
          <option value="" disabled selected>-- Selecciona un instructor --</option>
          @foreach ($instructores as $instructor)
            <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
          @endforeach
        </select>
      </div>

      {{-- Seleccionar Grupo --}}
      <div class="mb-3">
        <label for="grupo_id" class="form-label">Grupo</label>
        <select name="grupo_id" id="grupo_id" class="form-select" required>
          <option value="" disabled selected>-- Selecciona un grupo --</option>
          @foreach ($grupos as $grupo)
            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
          @endforeach
        </select>
      </div>

      {{-- Fecha --}}
      {{-- Día --}}
      <div class="mb-3">
        <label for="dia" class="form-label">Día</label>
        <input type="text" name="dia" id="dia" class="form-control" placeholder="Ejemplo: Lunes" required>
      </div>

      <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" required>
      </div>

      {{-- Hora inicio --}}
      <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora de inicio</label>
        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
      </div>

      {{-- Hora fin --}}
      <div class="mb-3">
        <label for="hora_fin" class="form-label">Hora de fin</label>
        <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary">Guardar Horario</button>
      <a href="{{ route('colab.principal') }}" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
@endsection