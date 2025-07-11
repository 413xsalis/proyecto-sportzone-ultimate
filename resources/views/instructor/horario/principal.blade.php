@extends('instructor.horario.layout')


@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


@section('content')

<main class="app-content">
  <div class="container-fluid py-4">

    {{-- Buscador inteligente --}}
    <div class="row mb-3">
      <div class="col-md-6">
        <input type="text" class="form-control" placeholder="Buscar alumno, clase o grupo...">
      </div>
    </div>

    {{-- Recordatorios importantes del día --}}
    <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
      <i class="bi bi-clock-history me-2 fs-4"></i>
      <div>
        Tienes una clase en 30 minutos: <strong>Fútbol Juvenil - Grupo A</strong> en la cancha 1.
      </div>
    </div>

    {{-- Vista semanal tipo calendario --}}
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Horario semanal</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-center">
            <thead class="table-light">
              <tr>
                <th>Hora</th>
                @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'] as $dia)
                <th>{{ $dia }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @for($h = 7; $h <= 18; $h++)
                <tr>
                <td>{{ $h }}:00</td>
                @for($d = 1; $d <= 6; $d++)
                  @php
                  $estado=['activo', 'pendiente' , 'cancelado' ][rand(0,2)];
                  $clase=$estado=='activo' ? 'Fútbol Grupo A' : ($estado=='pendiente' ? 'Básquet Grupo B' : '—' );
                  $bg=$estado=='activo' ? 'bg-success text-white' : ($estado=='pendiente' ? 'bg-warning text-dark' : 'bg-secondary text-white' );
                  @endphp
                  <td
                  class="{{ $clase === '—' ? '' : $bg }}"
                  style="background-color: {{ $clase === '—' ? '#f0f2f5' : '' }}; color: {{ $clase === '—' ? '#555' : 'white' }}; cursor: pointer;"
                  onclick="alert('Detalles de la clase: {{ $clase }}')">
                  {{ $clase }}
                  </td>

                  @endfor
                  </tr>
                  @endfor
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- Estadísticas de la semana --}}
    <div class="row">
      <div class="col-md-4">
        <div class="card text-white bg-success mb-3 shadow-sm">
          <div class="card-body">
            <h6 class="card-title"><i class="bi bi-check-circle me-2"></i>Clases impartidas</h6>
            <h3 class="card-text">15</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white bg-warning mb-3 shadow-sm">
          <div class="card-body">
            <h6 class="card-title"><i class="bi bi-clock me-2"></i>Clases pendientes</h6>
            <h3 class="card-text">4</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white bg-danger mb-3 shadow-sm">
          <div class="card-body">
            <h6 class="card-title"><i class="bi bi-x-circle me-2"></i>Clases canceladas</h6>
            <h3 class="card-text">1</h3>
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- Pequeña animación --}}
  <style>
    td:hover {
      transform: scale(1.02);
      transition: all 0.2s ease;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
  </style>

  <footer class="bg-white py-4 mt-auto">
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