@extends('instructor.horario.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection

@section('content')
<main class="app-content">
  <div class="container">
    <h2 class="mb-4">Horario del Instructor</h2>

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
          // Extrae las horas únicas de inicio de la colección de horarios y las ordena.
          $horas = $horarios->pluck('hora_inicio')->unique()->sort()->values();
          // Define un array con los días de la semana.
          $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
          @endphp

          {{-- Bucle principal para iterar sobre cada hora única. --}}
          @foreach ($horas as $hora)
          <tr>
            {{-- Muestra la hora de inicio de la fila. --}}
            <td>{{ substr($hora, 0, 5) }}</td>
            {{-- Bucle anidado para iterar sobre cada día de la semana. --}}
            @foreach ($dias as $dia)
            @php
            // Busca si existe un evento en el horario para la hora y el día actuales. `first()` detiene el bucle tan pronto como encuentra una coincidencia.
            $evento = $horarios->first(function ($h) use ($hora, $dia) {
            return strtolower($h->dia) === strtolower($dia) && $h->hora_inicio === $hora;
            });
            @endphp
            {{-- Celda del horario. `data-*` son atributos de datos para que JavaScript pueda acceder a la información. --}}
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
              {{-- Si hay un evento, muestra la información del grupo y el rango de horas. --}}
              <div class="bg-success text-white py-1 px-2 rounded" style="cursor:pointer; display:inline-block; min-width:100px;">
                <strong>{{ $evento->grupo->nombre ?? 'Sin grupo' }}</strong><br>
                <small>{{ substr($evento->hora_inicio, 0, 5) }} - {{ substr($evento->hora_fin, 0, 5) }}</small>
              </div>
              @else
              {{-- Si no hay evento, muestra un guion. --}}
              <span class="text-muted" style="cursor:pointer;">—</span>
              @endif
            </td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- Incluye la plantilla del modal. --}}
    @include('instructor.horario.partials.modal')
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let selectedCell = null;

      // 1️. Cargar actividades al iniciar: Este código está duplicado con la lógica de Blade de arriba. No es necesario.
      // fetch('/instructor/horarios/actividades')
      //   .then(response => response.json())
      //   .then(actividades => {
      //     actividades.forEach(act => {
      //       const cell = document.querySelector(`[data-dia="${act.dia}"][data-hora="${act.hora}"]`);
      //       if (cell) {
      //         cell.textContent = act.nombre;
      //         cell.style.backgroundColor = act.color;
      //         cell.style.borderRadius = "20px";
      //         cell.style.color = "white";
      //         cell.style.textAlign = "center";
      //         cell.dataset.actividadId = act.id;
      //       }
      //     });
      //   })
      //   .catch(error => console.error('Error cargando actividades:', error));

      // 2. Evento para abrir el modal
      document.querySelectorAll('.celda-horario').forEach(celda => {
        celda.addEventListener('click', function() {
          selectedCell = this;
          const horarioId = this.dataset.horarioId;
          const dia = this.dataset.dia;
          const hora = this.dataset.hora;

          // Al abrir el modal, inicializamos los campos
          document.getElementById('dia').value = dia;
          document.getElementById('hora').value = hora;
          document.getElementById('horario_id').value = horarioId;

          // Si ya hay actividad, mostrarla en el modal
          if (this.dataset.actividadId) {
            fetch(`/instructor/horarios/actividad/${this.dataset.actividadId}`)
              .then(response => response.json())
              .then(data => {
                document.getElementById('subgrupo_id').value = data.subgrupo_id;
                document.getElementById('actividad').value = data.nombre;
                document.getElementById('estado').value = data.estado;
              });
          } else {
            // Reinicia los campos del modal si la celda está vacía.
            document.getElementById('subgrupo_id').value = '';
            document.getElementById('actividad').value = '';
            document.getElementById('estado').value = 'activo';
          }

          const modal = new bootstrap.Modal(document.getElementById('actividadModal'));
          modal.show();
        });
      });

      // 3. Guardar actividad
      document.getElementById('guardarActividad').addEventListener('click', function() {
        const horario_id = document.getElementById('horario_id').value;
        const subgrupo_id = document.getElementById('subgrupo_id').value;
        const actividad = document.getElementById('actividad').value;
        const estado = document.getElementById('estado').value;

        // Validar que los campos no estén vacíos
        if (!horario_id || !subgrupo_id || !actividad) {
          Swal.fire({
            icon: 'warning',
            title: 'Faltan datos',
            text: 'Por favor, complete todos los campos.'
          });
          return;
        }

        // Envía los datos al servidor mediante una solicitud HTTP (fetch).
        fetch('/inst/horario/guardar', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
              horario_id,
              subgrupo_id,
              actividad,
              estado,
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Si la solicitud fue exitosa, actualiza la celda de la tabla con los nuevos datos.
              selectedCell.innerHTML = `<div class="bg-success text-white py-1 px-2 rounded" style="cursor:pointer; display:inline-block; min-width:100px;"><strong>${data.subgrupo_nombre}</strong><br><small>${data.hora_inicio} - ${data.hora_fin}</small></div>`;
              selectedCell.dataset.actividadId = data.id;
              selectedCell.dataset.grupo = data.subgrupo_nombre;
              selectedCell.dataset.nombre = actividad;
              selectedCell.dataset.estado = estado;
              selectedCell.dataset.horarioId = horario_id;

              // Muestra una alerta de éxito.
              Swal.fire({
                icon: 'success',
                title: 'Actividad guardada correctamente',
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
              });

              // Cierra el modal.
              const modal = bootstrap.Modal.getInstance(document.getElementById('actividadModal'));
              modal.hide();
            } else {
              // Muestra una alerta de error si la respuesta del servidor no fue exitosa.
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.error || 'No se pudo guardar la actividad.',
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000
              });
            }
          })
          .catch(error => {
            // Muestra una alerta de error si hay un problema de conexión.
            console.error('Error guardando actividad:', error);
            Swal.fire({
              icon: 'error',
              title: 'Error de conexión',
              text: 'Ocurrió un error al intentar comunicarse con el servidor.',
              toast: true,
              position: 'bottom-end',
              showConfirmButton: false,
              timer: 3000
            });
          });
      });
    });
  </script>
</main>
@endsection

{{-- Incluye las librerías de SweetAlert2 (alertas personalizadas) y otros scripts de Bootstrap. --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>