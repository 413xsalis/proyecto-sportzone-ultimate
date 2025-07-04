@extends('colaborador.reportes.layout')

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Reportes </h1>
          <p> Modulo Colaborador</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <!--<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
        </ul>
      </div> 

       <!-- Formulario para generar PDF -->
  <div class="container mt-4">
    <h2 class="mb-4">Generar Reporte de Inscripciones</h2>
    <form action="{{ route('reportes.inscripciones') }}" method="GET" class="row g-3">
      <div class="col-md-4">
        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
      </div>

      <div class="col-md-4">
        <label for="fecha_fin" class="form-label">Fecha Fin</label>
        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
      </div>

      <div class="col-md-4 align-self-end">
        <button type="submit" class="btn btn-primary w-100">Generar PDF</button>
      </div>
    </form>
  </div>

  <!-- Calendario -->
  <div class="row">
    <div class="col-md-10 main-content p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="titulo">Calendario</h1>
        <!--
        <div>
          <i class="bi bi-bell mx-2"></i>
          <i class="bi bi-box-arrow-right mx-2"></i>
          <i class="bi bi-person-circle"></i>
        </div>
        -->
      </div>

      <div class="col-md-8 mb-4">
        <label for="calendar" class="form-label">Selecciona una fecha:</label>
        <input type="date" class="form-control" id="calendar">
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>
@endsection

