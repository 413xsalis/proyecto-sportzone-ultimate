@extends('instructor.asistencia.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


@section('content')

<main class="app-content">
  <div class="tile p-4 rounded-4 shadow-sm">
    <h3 class="mb-4">Selecciona un grupo para tomar asistencia</h3>

    @if(isset($grupos) && count($grupos) > 0)
    <ul class="list-group">
      @foreach($grupos as $grupo)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ $grupo->nombre }}
        <a href="{{ route('asistencia.subgrupos', ['grupo_id' => $grupo->id]) }}" class="btn btn-success btn-sm">
          Tomar asistencia
        </a>
      </li>
      @endforeach
    </ul>
    @else
    <p>No hay grupos disponibles.</p>
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