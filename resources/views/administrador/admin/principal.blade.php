@extends('administrador.admin.layout')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="bi"></i> Bienvenido</h1>
        </div>
    </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon">
            <div class="info">
              <h4>Total de Alumnos</h4>
              <p><b>5</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon">
            <div class="info">
              <h4>Entrenadores</h4>
              <p><b>25</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon">
            <div class="info">
              <h4>Pagos Pendientes</h4>
              <p><b>10</b></p>
            </div>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">

             <label for="calendar" class="form-label">Selecciona una fecha:</label>
            <input type="date" class="form-control" id="calendar">
            <div class="ratio ratio-16x9">
              <div id="salesChart"></div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Asistencia Semanal</h3>
            <div class="ratio ratio-16x9">
              <div id="supportRequestChart"></div>
            </div>
          </div>
        </div>
      </div>

@endsection