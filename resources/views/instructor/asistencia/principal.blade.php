@extends('instructor.asistencia.layout')

{{-- Define la sección 'nav-message' que se mostrará en el layout principal. --}}
@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


{{-- Aquí se define el contenido principal de la página. El '@yield('content')' en el layout principal insertará este código. --}}
@section('content')

<main class="app-content">
  {{-- Contenedor principal con estilos de Bootstrap para un aspecto moderno. --}}
  <div class="tile p-4 rounded-4 shadow-sm">
    <h3 class="mb-4">Selecciona un grupo para tomar asistencia</h3>

    {{-- Bloque condicional: verifica si la variable $grupos existe y tiene elementos. --}}
    @if(isset($grupos) && count($grupos) > 0)
    <ul class="list-group">
      {{-- Itera sobre cada grupo en la colección $grupos --}}
      @foreach($grupos as $grupo)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{-- Muestra el nombre del grupo --}}
        {{ $grupo->nombre }}
        {{-- Botón para ir a la página de subgrupos, pasando el ID del grupo. La función `route()` crea la URL. --}}
        <a href="{{ route('asistencia.subgrupos', ['grupo_id' => $grupo->id]) }}" class="btn btn-success btn-sm">
          Tomar asistencia
        </a>
      </li>
      @endforeach
    </ul>
    @else
    {{-- Muestra este mensaje si no hay grupos disponibles. --}}
    <p>No hay grupos disponibles.</p>
    @endif
  </div>

  {{-- Bloque para el pie de página de la vista, con información de contacto y redes sociales. --}}
  <div class="row">
    <div class="col-md-4">
      <h5>SportZone</h5>
      <p class="text-muted">Sistema de gestión para escuelas deportivas</p>
      <div class="d-flex">
        {{-- Enlaces a redes sociales con íconos de Bootstrap --}}
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
      {{-- Muestra la versión y el año actual. `date('Y')` es una función de PHP. --}}
      <p class="text-muted mb-0">v1.0.0</p>
      <p class="text-muted">© {{ date('Y') }} Todos los derechos reservados</p>
    </div>
  </div>
</main>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>