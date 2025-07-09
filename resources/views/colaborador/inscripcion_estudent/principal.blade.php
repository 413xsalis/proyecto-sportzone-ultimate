@extends('colaborador.inscripcion_estudent.layout') 

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Inscripcion de Estudiantes </h1>
          <p> Modulo Colaborador</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
         <!-- <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li> -->
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li> 
        </ul>
      </div>
    
        <!-- Main content -->
        <main class="col-md-10 main-content p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="titulo">Calendario</h1>
          <div>
         <!--   <i class="bi bi-bell mx-2"></i>
            <i class="bi bi-box-arrow-right mx-2"></i>
            <i class="bi bi-person-circle"></i> -->
          </div>
        </div>

        <!--<div class="row">
          <!- Calendario -->
          <div class="col-md-6 mb-4">
            <label for="calendar" class="form-label">Selecciona una fecha:</label>
            <input type="date" class="form-control" id="calendar">
          </div>
          <br>


<!-- Formulario -->
<div class="col-md-12 mb-4">
  <h2>Formulario de Inscripción</h2>
  <form action="{{ route('estudiantes.store') }}" method="POST">
    @csrf
    <br>
    <div class="row">
    <div class="col-md-6 mb-3">
      <label for="documento" class="form-label">Documento</label>
      <input type="number" class="form-control" name="documento" id="documento" required>
    </div>

    <div class="col-md-6 mb-3">
      <label for="nombre_1" class="form-label">Nombre 1</label>
      <input type="text" class="form-control" name="nombre_1" id="nombre_1" required>
    </div>

    <div class="col-md-6 mb-3">
      <label for="nombre_2" class="form-label">Nombre_2</label>
      <input type="text" class="form-control" name="nombre_2" id="nombre_2" required>
    </div>

    <div class="col-md-6 mb-3">
      <label for="apellido_1" class="form-label">Apellido_1</label>
      <input type="text" class="form-control" name="apellido_1" id="apellido_1" required>
    </div> 

    <div class="col-md-6 mb-3">
      <label for="apellido_2" class="form-label">Apellido_2</label>
      <input type="text" class="form-control" name="apellido_2" id="apellido_2" required>
    </div> 

    <div class="col-md-6 mb-3">
      <label for="telefono" class="form-label">Telefono</label>
      <input type="number" class="form-control" name="telefono" id="telefono" required>
    </div>

    <div class="col-md-6 mb-3">
      <label for="nombre_contacto" class="form-label">Telefono de Contacto</label>
      <input type="number" class="form-control" name="telefono_contacto" id="telefono_contacto" required>
    </div>

    <div class="col-md-6 mb-3">
      <label for="eps" class="form-lebel">EPS</label>
      <input type="text" class="form-control" name="eps" id="eps">
    </div>

    <div class="col-md-6 mb-3">
        <label for="id_grupo_nivel" class="form-label">Grupo o Nivel</label>
        <select class="form-select" id="id_grupo_nivel" name="id_grupo_nivel">
          <option value="">Seleccione un grupo</option>
          {{-- Aquí puedes usar un foreach si tienes datos de grupos desde el controlador --}}
          <option value="1">Nivel 1</option>
          <option value="2">Nivel 2</option>
          <option value="3">Nivel 3</option>
        </select>
      </div>
    </div>

    <button type="submit" class="btn btn-success">Registrar</button>
  </form>
  <br>
</div>
      <!-- Lista de estudiantes inscritos desplegable -->
  <div class="tile">
  <h2>
    <button id="toggleListaBtn"
       class="btn btn-secondary"
       type="button"
       data-bs-toggle="collapse"
       data-bs-target="#listadoEstudiantes"
       aria-expanded="false"
       aria-controls="listadoEstudiantes">
       Ver Lista de Estudiantes Inscritos
    </button>
  </h2>

  <div class="collapse fade" id="listadoEstudiantes">
    <div class="table-responsive mt-3">
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Telefono de Contacto</th>
            <th>EPS</th>
            <th>Grupo/Nivel</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($estudiantes as $est)
            <tr>
              <td>{{ $est->id }}</td>
              <td>{{ $est->documento }}</td>
              <td>{{ $est->nombre_1 }} {{ $est->apellido_1 }}</td>
              <td>{{ $est->telefono }}</td>
              <td>{{ $est->telefono_contacto}}</td>
              <td>{{ $est->eps }}</td>
              <td>{{ $est->id_grupo_nivel }}</td>
              <td>
        <a href="{{ route('estudiantes.edit', $est->id) }}" class="btn btn-sm btn-warning">Editar</a> 

        <form action="{{ route('estudiantes.destroy', $est->id) }}" method="POST" style="display:inline-block;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
            Eliminar
          </button>
        </form>
      </td>
            </tr>
          @empty
            <tr> 
              <td colspan="6" class="text-center">No hay estudiantes registrados.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
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

   

          <!-- Asistencia semanal ->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header asistencia-header">
                Asistencia Semanal
              </div>
              <div class="card-body" id="asistencia">
                <p>Sin datos por ahora.</p>
              </div> -->
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
    </main>
    @endsection 