@extends('instructor.reporte.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


@section('content')

<main class="app-content">
  <div class="container mt-5">
    <h4 class="mb-4 text-center fw-bold text-primary">Reporte de Asistencias</h4>

    {{--
      Formulario de filtrado por subgrupo.
      - `method="GET"`: Utiliza el método GET para enviar los datos, ideal para filtros.
      - `action="{{ route('inst.reporte') }}"`: Envía los datos del formulario a la misma URL para recargar la página con el filtro aplicado.
    --}}
    <form method="GET" action="{{ route('inst.reporte') }}" class="row g-3 mb-4">
      <div class="col-md-4">
        <label for="subgrupo" class="form-label">Filtrar por Subgrupo</label>
        <select name="subgrupo" id="subgrupo" class="form-select" required>
          <option value="">Seleccione...</option>
          @foreach($subgrupos as $sub)
          <option value="{{ $sub->id }}" {{ request('subgrupo') == $sub->id ? 'selected' : '' }}>
            {{ $sub->nombre }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-success w-100">Filtrar</button>
      </div>
    </form>
    {{--
      Tabla de datos que muestra los registros de asistencia.
      - `table-responsive`: Clase de Bootstrap para hacer la tabla responsive en dispositivos pequeños.
    --}}
    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-primary">
          <tr>
            <th>Estudiante</th>
            <th>Documento</th>
            <th>Subgrupo</th>
            <th>Fecha</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          {{--
            Directiva `forelse`: Recorre `$asistencias` y, si la colección está vacía, muestra el bloque `@empty`.
            Esto evita tener que usar un `if` por separado.
          --}}
          @forelse($asistencias as $asis)
          <tr>
            <td>{{ $asis->estudiante->nombre_completo ?? 'N/A' }}</td>
            <td>{{ $asis->estudiante->documento ?? 'N/A' }}</td>
            <td>{{ $asis->subgrupo->nombre ?? 'N/A' }}</td>
            <td>{{ $asis->fecha }}</td>
            <td>
              <span class="badge {{ $asis->estado == 'Presente' ? 'bg-success' : 'bg-danger' }}">
                {{ $asis->estado }}
              </span>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5">No hay registros de asistencia para mostrar.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!-- <div class="row">
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
  </div> -->
</main>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>