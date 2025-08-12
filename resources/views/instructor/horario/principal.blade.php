@extends('instructor.horario.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection

@section('content')
<main class="app-content">
  <div class="container">
    <h2 class="mb-4">Horario del Instructor</h2>

    <!-- Tabla de horario semanal -->
    <div class="table-responsive mt-4">
      <table class="table table-bordered text-center" id="tablaHorario">
        <thead class="table-light">
          <tr>
            <th>Hora</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>Sábado</th>
            <th>Domingo</th>
          </tr>
        </thead>
        <tbody>
          @php
          $horas = $horarios->pluck('hora_inicio')->unique()->sort()->values();
          $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
          @endphp

          @foreach ($horas as $hora)
          <tr>
            <td>{{ substr($hora, 0, 5) }}</td>
            @foreach ($dias as $dia)
            @php
            $evento = $horarios->first(function ($h) use ($hora, $dia) {
            return strtolower($h->dia) === strtolower($dia) && $h->hora_inicio === $hora;
            });
            @endphp
            <td class="celda-horario"
              data-dia="{{ strtolower($dia) }}"
              data-hora="{{ $hora }}"
              data-horario-id="{{ $evento->id ?? '' }}"
              @if($evento)
              data-grupo="{{ $evento->grupo->nombre ?? '' }}"
              data-nombre="{{ $evento->nombre ?? '' }}"
              data-estado="{{ $evento->estado ?? 'Programada' }}"
              @endif>
              @if ($evento)
              <div class="bg-success text-white py-1 px-2 rounded" style="cursor:pointer; display:inline-block; min-width:100px;">
                <strong>{{ $evento->grupo->nombre ?? 'Sin grupo' }}</strong><br>
                <small>{{ substr($evento->hora_inicio, 0, 5) }} - {{ substr($evento->hora_fin, 0, 5) }}</small>
              </div>
              @else
              <span class="text-muted" style="cursor:pointer;">—</span>
              @endif
            </td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Modal para asignar actividad -->
    @include('instructor.horario.partials.modal')
  </div>

  <!-- Script para cargar actividades y abrir modal -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let selectedCell = null;

      // 1️. Cargar actividades al iniciar
      fetch('/instructor/horarios/actividades')
        .then(response => response.json())
        .then(actividades => {
          actividades.forEach(act => {
            const cell = document.querySelector(`[data-dia="${act.dia}"][data-hora="${act.hora}"]`);
            if (cell) {
              cell.textContent = act.nombre;
              cell.style.backgroundColor = act.color;
              cell.style.borderRadius = "20px";
              cell.style.color = "white";
              cell.style.textAlign = "center";
              cell.dataset.actividadId = act.id;
            }
          });
        })
        .catch(error => console.error('Error cargando actividades:', error));

      // 2️. Evento para abrir el modal
      document.querySelectorAll('.celda-horario').forEach(celda => {
        celda.addEventListener('click', function() {
          selectedCell = this;
          const dia = this.dataset.dia;
          const hora = this.dataset.hora;

          document.getElementById('dia').value = dia;
          document.getElementById('hora').value = hora;

          // Si ya hay actividad, mostrarla en el modal
          if (this.dataset.actividadId) {
            fetch(`/instructor/horarios/actividad/${this.dataset.actividadId}`)
              .then(response => response.json())
              .then(data => {
                document.getElementById('actividad').value = data.nombre;
                document.getElementById('estado').value = data.estado;
              });
          } else {
            document.getElementById('actividad').value = '';
            document.getElementById('estado').value = '';
          }

          const modal = new bootstrap.Modal(document.getElementById('actividadModal'));
          modal.show();
        });
      });

      // 3️. Guardar actividad
      document.getElementById('guardarActividad').addEventListener('click', function() {
        const actividad = document.getElementById('actividad').value;
        const estado = document.getElementById('estado').value;
        const dia = document.getElementById('dia').value;
        const hora = document.getElementById('hora').value;

        fetch('/instructor/horarios/guardar', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
              actividad,
              estado,
              dia,
              hora
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              selectedCell.textContent = actividad;
              selectedCell.style.backgroundColor = data.color;
              selectedCell.style.borderRadius = "20px";
              selectedCell.style.color = "white";
              selectedCell.style.textAlign = "center";
              selectedCell.dataset.actividadId = data.id;

              Swal.fire({
                icon: 'success',
                title: 'Guardado correctamente',
                showConfirmButton: false,
                timer: 1500
              });

              bootstrap.Modal.getInstance(document.getElementById('actividadModal')).hide();
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo guardar la actividad.'
              });
            }
          })
          .catch(error => console.error('Error guardando actividad:', error));
      });
    });
  </script>
</main>
@endsection

<!-- Recursos adicionales -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>