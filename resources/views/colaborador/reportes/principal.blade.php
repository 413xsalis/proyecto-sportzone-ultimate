@extends('colaborador.reportes.layout')

@section('content')
<main class="content">
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

  <hr class="my-5">

    <!-- Reporte de Pagos -->
    <div class="container mt-4">
        <h2 class="mb-4">Reporte de Pagos</h2>
        <form action="{{ route('reportes.pagos') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <label for="tipo" class="form-label">Tipo de Pago</label>
                <select name="tipo" id="tipo" class="form-select">
                    <option value="">Todos</option>
                    <option value="inscripcion">Inscripción</option>
                    <option value="mensualidad">Mensualidad</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="fecha_inicio_p" class="form-label">Fecha Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio_p" name="fecha_inicio">
            </div>

            <div class="col-md-3">
                <label for="fecha_fin_p" class="form-label">Fecha Fin</label>
                <input type="date" class="form-control" id="fecha_fin_p" name="fecha_fin">
            </div>

            <div class="col-md-3 align-self-end d-flex gap-2">
                <button type="submit" class="btn btn-danger w-50">PDF</button>
                <button type="button" id="btnExcel" class="btn btn-success w-50">Excel</button>
            </div>

            <script>
              document.getElementById("btnExcel").addEventListener("click", function () {
                  let tipo = document.getElementById("tipo").value;
                  let inicio = document.getElementById("fecha_inicio_p").value;
                  let fin = document.getElementById("fecha_fin_p").value;

                  let url = "{{ route('reportes.pagos.excel') }}" + "?tipo=" + tipo + "&fecha_inicio=" + inicio + "&fecha_fin=" + fin;
                  window.location.href = url;
              });
              </script>

        </form>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>
@endsection



