@extends('instructor.asistencia.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


@section('content')

<main class="app-content">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="page-title">Asistencia</h3>
            <div>
                <label for="filtroSubgrupo" class="form-label fw-bold me-2">Filtrar por subgrupo:</label>
                <select id="filtroSubgrupo" class="form-select w-auto d-inline-block" onchange="filtrarSubgrupos()">
                    <option value="todos">Mostrar todos</option>
                    {{-- Bucle para generar las opciones del selector con los subgrupos disponibles --}}
                    @foreach($subgrupos as $subgrupo)
                        <option value="subgrupo-{{ $subgrupo->id }}">{{ $subgrupo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Condicional para verificar si hay subgrupos --}}
        @if($subgrupos->isEmpty())
            <div class="col-12">
                <p class="text-center text-muted">No hay subgrupos asignados a este grupo.</p>
            </div>
        @else
            {{-- Bucle principal para mostrar cada subgrupo --}}
            @foreach($subgrupos as $subgrupo)
                {{-- Cada div de subgrupo tiene una clase única para que el filtro de JavaScript lo pueda identificar --}}
                <div class="col-12 subgrupo-container subgrupo-{{ $subgrupo->id }}">
                    <div class="tile shadow-sm rounded-4 mb-4">
                        <div class="tile-title">
                            <h5 class="mb-0">{{ $subgrupo->nombre }}</h5>
                        </div>
                        <div class="tile-body">
                            {{-- Condicional para verificar si el subgrupo tiene estudiantes --}}
                            @if($subgrupo->estudiantes->isEmpty())
                                <p class="text-muted text-center">No hay estudiantes en este subgrupo.</p>
                            @else
                                {{-- Formulario para enviar la asistencia --}}
                                <form method="POST" action="{{ route('asistencia.guardar') }}">
                                    @csrf
                                    {{-- Campos ocultos para enviar el ID del subgrupo y la fecha actual --}}
                                    <input type="hidden" name="subgrupo_id" value="{{ $subgrupo->id }}">
                                    <input type="hidden" name="fecha" value="{{ date('Y-m-d') }}">

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Asistencia</th>
                                                    <th>Detalles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Bucle para mostrar cada estudiante en el subgrupo --}}
                                                @foreach($subgrupo->estudiantes as $estudiante)
                                                    <tr>
                                                        <td>{{ $estudiante->nombre_1 }} {{ $estudiante->nombre_2 }} {{ $estudiante->apellido_1 }} {{ $estudiante->apellido_2 }}</td>
                                                        <td>
                                                            <select name="asistencia[{{ $estudiante->documento }}]" class="form-select">
                                                                <option value="presente">Presente</option>
                                                                <option value="ausente">Ausente</option>
                                                                <option value="justificado">Justificado</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#infoModal{{ $estudiante->id }}">
                                                                Ver info
                                                            </button>
                                                            @include('instructor.asistencia.partials.modal', ['estudiante' => $estudiante])
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-start mt-3">
                                        <button type="submit" class="btn btn-success">Guardar asistencia</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{-- Bloque para el mensaje de éxito --}}
    @if(session('success'))
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toastSuccess');
                if (toast) {
                    const bsToast = bootstrap.Toast.getOrCreateInstance(toast);
                    bsToast.hide();
                }
            }, 5000);
            localStorage.setItem('attendanceSaved', 'true');
            localStorage.setItem('attendanceGroup', '{{ $grupo->nombre }}');
            localStorage.setItem('attendanceSubgroup', '{{ $subgrupo->nombre }}');
        </script>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
            <div id="toastSuccess" class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
</main>
@endsection
{{-- Scripts de JavaScript --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    //Función JavaScript para filtrar los subgrupos 
    function filtrarSubgrupos() {
        const valorSeleccionado = document.getElementById('filtroSubgrupo').value;
        const subgrupos = document.querySelectorAll('.subgrupo-container');

        subgrupos.forEach(div => {
            if (valorSeleccionado === 'todos') {
                div.style.display = 'block';
            } else {
                //Muestra u oculta el div dependiendo de si su clase coincide con el valor seleccionado 
                div.style.display = div.classList.contains(valorSeleccionado) ? 'block' : 'none';
            }
        });
    }
</script>