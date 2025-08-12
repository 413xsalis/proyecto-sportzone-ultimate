@extends('colaborador.gestion_clases.layout')

@section('title', 'Gestión de Clases')

@section('content')
<main class="content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Gestión de Clases </h1>
      <p>Módulo Colaborador</p>
    </div>
  </div>

  <div class="container mt-4">
    <h2 class="mb-4 text-center">Horario de Clases</h2>

    <table class="table table-bordered table-striped">
      <thead class="table-dark text-center">
  <tr>
    <th>Día</th>
    <th>Hora</th>
    <th>Instructor</th>
    <th>Grupo</th>
    <th>Acciones</th>
  </tr>
</thead>
<tbody class="text-center">
  @foreach ($horarios as $horario)
    <tr>
      <td>{{ ucfirst($horario->dia) }}</td>
      <td>{{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</td>
      <td>{{ $horario->instructor->nombre }}</td>
      <td>{{ $horario->grupo->nombre }}</td>
      <td>
        <a href="{{ route('horarios.edit', $horario->id) }}" class="btn btn-sm btn-primary">Editar</a>

        <form action="{{ route('horarios.destroy', $horario->id) }}" method="POST" style="display:inline-block;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este horario?')">Eliminar</button>
        </form>
      </td>
    </tr>
  @endforeach
</tbody>

    </table>
  </div>
<br>
<br>
  <h3 class="mb-4 text-center">
    {{ isset($editar) && $editar ? 'Editar Horario' : 'Editar Nuevo Horario' }}
</h3>

<form action="{{ isset($editar) && $editar ? route('horarios.update', $horario->id) : route('horarios.store') }}" method="POST" class="mb-5">
    @csrf
    @if(isset($editar) && $editar)
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-md-3">
            <label for="dia" class="form-label">Día</label>
            <select name="dia" id="dia" class="form-select" required>
                <option value="">Selecciona un día</option>
                @foreach(['lunes','martes','miércoles','jueves','viernes','sábado','domingo'] as $dia)
                    <option value="{{ $dia }}" {{ (old('dia', $horario->dia ?? '') == $dia) ? 'selected' : '' }}>
                        {{ ucfirst($dia) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label for="hora_inicio" class="form-label">Hora Inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control"
                value="{{ old('hora_inicio', $horario->hora_inicio ?? '') }}" required>
        </div>

        <div class="col-md-2">
            <label for="hora_fin" class="form-label">Hora Fin</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control"
                value="{{ old('hora_fin', $horario->hora_fin ?? '') }}" required>
        </div>

        <div class="col-md-2">
            <label for="instructor_id" class="form-label">Instructor</label>
            <select name="instructor_id" id="instructor_id" class="form-select" required>
                <option value="">Selecciona</option>
                @foreach($instructores as $instructor)
                    <option value="{{ $instructor->id }}"
                        {{ (old('instructor_id', $horario->instructor_id ?? '') == $instructor->id) ? 'selected' : '' }}>
                        {{ $instructor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label for="grupo_id" class="form-label">Grupo</label>
            <select name="grupo_id" id="grupo_id" class="form-select" required>
                <option value="">Selecciona</option>
                @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id }}"
                        {{ (old('grupo_id', $horario->grupo_id ?? '') == $grupo->id) ? 'selected' : '' }}>
                        {{ $grupo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-1 d-flex align-items-end">
            <button type="submit" class="btn btn-{{ isset($editar) && $editar ? 'primary' : 'success' }} w-100">
                {{ isset($editar) && $editar ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </div>
</form>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
        </div>
    </div>
</form>

</main>
@endsection
