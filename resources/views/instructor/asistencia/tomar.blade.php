@extends('instructor.asistencia.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


@section('content')

<main class="app-content">
  <div class="tile p-4 rounded-4 shadow-sm">
    <h3 class="mb-4">Asistencia - {{ $grupo->nombre }} ({{ date('d/m/Y') }})</h3>

    @if($estudiantes->isEmpty())
    <div class="alert alert-warning">
      No hay estudiantes asignados a este grupo.
    </div>
    @else
    <form method="POST" action="{{ route('asistencia.guardar') }}">
      @csrf
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif
      <input type="hidden" name="nombre_grupo" value="{{ $grupo->nombre }}">
      <div class="mb-3">
        <label for="fecha" class="form-label">Fecha de asistencia:</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}">
      </div>
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Estudiante</th>
            <th>Estado</th>
            <th>Detalles</th>
          </tr>
        </thead>
        <tbody>
          @foreach($estudiantes as $index => $est)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $est->nombre_1 }} {{ $est->apellido_1 }}</td>
            <td>
              <select name="asistencia[{{ $est->documento }}]" class="form-select form-select-sm">
                <option value="presente">Presente</option>
                <option value="ausente">Ausente</option>
                <option value="justificado">Justificado</option>
              </select>
            </td>
            <td>
              <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                data-bs-target="#modal{{ $est->documento }}">
                Ver más
              </button>
            </td>
          </tr>
          @include('instructor.asistencia.partials.modal', ['estudiante' => $est])
          @endforeach
        </tbody>
      </table>

      <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">Guardar Asistencia</button>
      </div>
    </form>
    @endif
  </div>
  <div class="row">
    <div class="col-md-4">
      <h5>SportZone</h5>
      <p class="text-muted">Sistema de gestión para escuelas deportivas</p>
      <div class="d-flex">
        <a href="#" class="me-3 text-muted"><i class="bi bi-facebook"></i></a>
        <a href="#" class="me-3 text-muted"><i class="bi bi-instagram"></i></a>
        <a href="#" class="me-3 text-muted"><i class="bi bi-twitter"></i></a>
        <a href="#" class="text-muted"><i class="bi bi-youtube"></i></a>
      </div>
    </div>
    <div class="col-md-8 text-md-end">
      <h5>Contacto</h5>
      <p class="text-muted mb-0">
        <i class="bi bi-envelope me-2"></i> info@sportzone.edu
      </p>
      <p class="text-muted mb-0">
        <i class="bi bi-telephone me-2"></i> +57 123 456 7890
      </p>
      <p class="text-muted mb-0">v1.0.0</p>
      <p class="text-muted">© {{ date('Y') }} Todos los derechos reservados</p>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>
</main>
@endsection