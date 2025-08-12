@extends('instructor.asistencia.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


@section('content')

<main class="app-content">
    <div class="container">
        <div class="mb-4">
            <label for="filtroSubgrupo" class="form-label fw-bold">Filtrar por subgrupo:</label>
            <select id="filtroSubgrupo" class="form-select w-auto d-inline-block" onchange="filtrarSubgrupos()">
                <option value="todos">Mostrar todos</option>
                @foreach($subgrupos as $subgrupo)
                <option value="subgrupo-{{ $subgrupo->id }}">{{ $subgrupo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <h3 class="mb-4"> {{ $grupo->nombre }}</h3>
        @if($subgrupos->isEmpty())
        <p>No hay subgrupos asignados a este grupo.</p>
        @else
        @foreach($subgrupos as $subgrupo)
        <div class="card my-3 shadow-sm subgrupo-container subgrupo-{{ $subgrupo->id }}">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-3">{{ $subgrupo->nombre }}</h5>
                </div>

                @if($subgrupo->estudiantes->isEmpty())
                <p class="text-muted">No hay estudiantes en este subgrupo.</p>
                @else
                <form method="POST" action="{{ route('asistencia.guardar') }}">
                    @csrf
                    <input type="hidden" name="subgrupo_id" value="{{ $subgrupo->id }}">
                    <input type="hidden" name="fecha" value="{{ date('Y-m-d') }}">


                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Asistencia</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subgrupo->estudiantes as $estudiante)
                            <tr>
                                <td>{{ $estudiante->nombre_1 }} {{ $estudiante->nombre_2 }} {{ $estudiante->apellido_1 }} {{ $estudiante->apellido_2 }}
                                </td>
                                <td>
                                    <select name="asistencia[{{ $estudiante->documento }}]" class="form-select">
                                        <option value="presente">Presente</option>
                                        <option value="ausente">Ausente</option>
                                        <option value="justificado">Justificado</option>
                                    </select>
                                </td>

                                <td>
                                    <!-- Botón que abre el modal -->
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#infoModal{{ $estudiante->id }}">
                                        Ver info
                                    </button>

                                    <!-- Incluir modal desde archivo externo -->
                                    @include('instructor.asistencia.partials.modal', ['estudiante' => $estudiante])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-success mt-3">Guardar asistencia</button>
                </form>
                @endif
            </div>
        </div>
        @endforeach
        @endif
    </div>
    @if(session('success'))
    <script>
        setTimeout(() => {
            const toast = document.getElementById('toastSuccess');
            if (toast) {
                const bsToast = bootstrap.Toast.getOrCreateInstance(toast);
                bsToast.hide();
            }
        }, 5000);
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function filtrarSubgrupos() {
        const valorSeleccionado = document.getElementById('filtroSubgrupo').value;
        const subgrupos = document.querySelectorAll('.subgrupo-container');

        subgrupos.forEach(div => {
            if (valorSeleccionado === 'todos') {
                div.style.display = 'block';
            } else {
                div.style.display = div.classList.contains(valorSeleccionado) ? 'block' : 'none';
            }
        });
    }
</script>
</main>
@endsection