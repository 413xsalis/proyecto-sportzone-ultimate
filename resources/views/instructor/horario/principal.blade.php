@extends('instructor.horario.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection

@section('content')
<main class="app-content">
  <div class="container">
    <h2 class="mb-4">Horario del Instructor</h2>
    <form id="filter-form" action="{{ route('inst.horarios') }}" method="GET">
      <div class="row align-items-end mb-4">
        <div class="col-sm-6 col-lg-4">
          <label for="instructor_select">Seleccionar Instructor</label>
          <select class="form-control" id="instructor_select" name="instructorId">
            <option value="">Todos los instructores</option>
            @foreach($instructores as $instructor)
            <option value="{{ $instructor->id }}">{{ $instructor->nombre }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-6 col-lg-2">
          <button type="submit" class="btn btn-info w-100">Filtrar</button>
        </div>
      </div>
    </form>
    <div class="table-responsive mt-4">
      <table class="table table-bordered text-center" id="tablaHorario">
        <thead class="table-light">
          <tr>
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
          // Extrae las horas únicas de la colección de horarios y las ordena.
          $horas = $horarios->pluck('hora_inicio')->unique()->sort()->values();
          // Define un array con los días de la semana.
          $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
          @endphp

          {{-- Bucle principal para iterar sobre cada hora única. --}}
          @foreach ($horas as $hora)
          <tr>
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
              <div class="bg-success text-white py-1 px-2 rounded btn-actividad" style="cursor:pointer; display:inline-block; min-width:100px;">
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
  @push('scripts')
  <script>
    document.getElementById('filter-form').addEventListener('submit', function(event) {
      event.preventDefault();
      const instructorId = document.getElementById('instructor_select').value;
      window.location.href = `{{ route('inst.horarios') }}/${instructorId}`;
    });

    document.addEventListener('DOMContentLoaded', function() {
      let selectedCell = null;

      // Obtener la URL de la ruta de guardado desde Blade
      const guardarUrl = "{{ route('inst.horarios.guardar') }}";

      // Mapea el estado a las clases de color de Bootstrap
      const estadoColores = {
        'activo': {
          bg: 'bg-success',
          border: 'border-success',
          text: 'text-white'
        },
        'cancelado': {
          bg: 'bg-danger',
          border: 'border-danger',
          text: 'text-white'
        },
        'pendiente': {
          bg: 'bg-warning',
          border: 'border-warning',
          text: 'text-dark'
        }
      };

      // Función para aplicar los colores iniciales o por defecto
      function aplicarColorInicial() {
        document.querySelectorAll('.celda-horario').forEach(celda => {
          const estado = celda.dataset.estado;
          const contenedorActividad = celda.querySelector('.btn-actividad');

          // Si no hay una actividad preexistente en la celda
          if (!contenedorActividad) {
            const horarioId = celda.dataset.horarioId;
            const subgrupoId = celda.dataset.subgrupoId;
            const actividadNombre = celda.dataset.nombre;

            // Verifica si la celda es "asignable" (tiene horario_id pero no subgrupo_id ni nombre)
            if (horarioId && (!subgrupoId || !actividadNombre)) {
              celda.innerHTML = `<div class="bg-info text-white border border-info py-1 px-2 rounded btn-actividad" style="cursor:pointer; display:inline-block; min-width:100px;">
                            <strong>+ Añadir</strong><br>
                            <small>Actividad</small>
                        </div>`;
              celda.dataset.estado = '';
            }
          } else {
            // Si ya hay una actividad, aplica el color según su estado
            const colores = estadoColores[estado.toLowerCase().trim()] || {
              bg: 'bg-secondary',
              border: 'border-secondary',
              text: 'text-white'
            };
            contenedorActividad.classList.remove('bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'border-secondary', 'border-success', 'border-danger', 'border-warning', 'text-white', 'text-dark', 'bg-info', 'border-info');
            contenedorActividad.classList.add(colores.bg, colores.border, colores.text);
          }
        });
      }

      // Aplica los colores al cargar la página
      aplicarColorInicial();

      // 1. Evento para abrir el modal al hacer clic en el botón de la actividad.
      document.querySelectorAll('.btn-actividad').forEach(btn => {
        btn.addEventListener('click', function() {
          const celda = this.closest('.celda-horario');
          selectedCell = celda;

          const horarioId = celda.dataset.horarioId;
          const dia = celda.dataset.dia;
          const hora = celda.dataset.hora;

          document.getElementById('dia').value = dia;
          document.getElementById('hora').value = hora;
          document.getElementById('horario_id').value = horarioId;
          document.getElementById('subgrupo_id').value = celda.dataset.subgrupoId || '';
          document.getElementById('actividad').value = celda.dataset.nombre || '';
          document.getElementById('estado').value = celda.dataset.estado || 'activo';

          const modal = new bootstrap.Modal(document.getElementById('actividadModal'));
          modal.show();
        });
      });

      // 2. Evento para guardar la actividad.
      document.getElementById('guardarActividad').addEventListener('click', function() {
        const horario_id = document.getElementById('horario_id').value;
        const subgrupo_id = document.getElementById('subgrupo_id').value;
        const actividad = document.getElementById('actividad').value;
        const estado = document.getElementById('estado').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (!horario_id || !subgrupo_id || !actividad) {
          Swal.fire({
            icon: 'warning',
            title: 'Faltan datos',
            text: 'Por favor, complete todos los campos.',
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000
          });
          return;
        }

        fetch(guardarUrl, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
              horario_id: horario_id,
              subgrupo_id: subgrupo_id,
              actividad: actividad,
              estado: estado,
              _token: csrfToken
            })
          })
          .then(response => {
            if (!response.ok) {
              console.error("Respuesta del servidor no exitosa:", response.status, response.statusText);
              throw new Error('Error en el servidor. Revisa el log de Laravel.');
            }
            return response.json();
          })
          .then(data => {
            console.log("Datos recibidos del servidor:", data);

            if (data.success) {
              // Mapea el estado a las clases de color de Bootstrap
              const estadoRecibido = data.estado ? data.estado.toLowerCase().trim() : '';
              const colores = estadoColores[estadoRecibido] || {
                bg: 'bg-secondary',
                border: 'border-secondary',
                text: 'text-white'
              };

              const grupoSubgrupo = `${data.grupo_nombre} / ${data.subgrupo_nombre}`;

              selectedCell.innerHTML = `<div class="${colores.bg} ${colores.text} border ${colores.border} py-1 px-2 rounded btn-actividad" style="cursor:pointer; display:inline-block; min-width:100px;">
                        <strong>${grupoSubgrupo}</strong><br>
                        <small>${data.hora_inicio} - ${data.hora_fin}</small>
                    </div>`;

              selectedCell.dataset.actividadId = data.id;
              selectedCell.dataset.subgrupoId = subgrupo_id;
              selectedCell.dataset.grupo = data.grupo_nombre;
              selectedCell.dataset.nombre = actividad;
              selectedCell.dataset.estado = estado;
              selectedCell.dataset.horarioId = horario_id;

              Swal.fire({
                icon: 'success',
                title: 'Actividad guardada correctamente',
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
              });

              const modal = bootstrap.Modal.getInstance(document.getElementById('actividadModal'));
              modal.hide();
            } else {
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
            console.error('Error guardando actividad:', error);
            Swal.fire({
              icon: 'error',
              title: 'Error de conexión',
              text: error.message || 'Ocurrió un error al intentar comunicarse con el servidor.',
              toast: true,
              position: 'bottom-end',
              showConfirmButton: false,
              timer: 5000
            });
          });
      });
    });
  </script>
  @endpush

  {{-- Incluye las librerías de SweetAlert2 (alertas personalizadas) y otros scripts de Bootstrap. --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="app.js"></script>
  @stack('scripts')
</main>
@endsection