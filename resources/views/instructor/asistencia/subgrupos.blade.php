@extends('instructor.asistencia.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


@section('content')

<main class="app-content">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="page-title">Asistencia</h3>


            {{-- Formulario para crear nuevo subgrupo --}}
            <div class="form-container">
                <div class="form-container-bottom-right">
                    <form method="POST" action="{{ route('subgrupos.store') }}" class="form-subgrupo-simple">
                        @csrf
                        <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                        <div class="input-group-simple">
                            <input type="text" name="nombre" class="input-field-simple" placeholder="Nombre del nuevo subgrupo" required>
                            <button type="submit" class="submit-button-simple">
                                + Agregar
                            </button>
                        </div>
                    </form>
                </div>

                <style>
                    .form-container-bottom-right {
                        position: fixed;
                        /* Lo posiciona de forma fija en la pantalla */
                        bottom: 30px;
                        /* Distancia desde el borde inferior */
                        right: 30px;
                        /* Distancia desde el borde derecho */
                        z-index: 1000;
                        /* Asegura que esté por encima de otros elementos */
                    }

                    .form-subgrupo-simple {
                        background-color: #ffffff;
                        border: 1px solid #000000;
                        border-radius: 8px;
                        padding: 15px 20px;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                        display: flex;
                        align-items: center;
                        gap: 30px;
                        /* Valor ajustado para más espacio */
                    }

                    .input-group-simple {
                        display: flex;
                        align-items: center;
                        width: 100%;
                    }

                    .input-field-simple {
                        flex-grow: 1;
                        /* Permite que el input ocupe el espacio disponible */
                        padding: 10px 12px;
                        border: 1px solid #cccccc;
                        /* Borde gris claro para el input */
                        border-radius: 5px;
                        font-size: 0.95rem;
                        color: #333333;
                        background-color: #f9f9f9;
                        /* Un blanco muy ligero para el fondo del input */
                        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                    }

                    .input-field-simple:focus {
                        outline: none;
                        border-color: #88bbff;
                        /* Borde azul suave al enfocar */
                        box-shadow: 0 0 5px rgba(136, 187, 255, 0.5);
                    }

                    .input-field-simple::placeholder {
                        color: #999999;
                    }

                    .submit-button-simple {
                        padding: 10px 18px;
                        border: none;
                        border-radius: 5px;
                        font-size: 0.95rem;
                        font-weight: 500;
                        /* Un poco más de peso para la fuente */
                        cursor: pointer;
                        background-color: #88bbff;
                        /* Azul claro minimalista */
                        color: white;
                        transition: background-color 0.2s ease-in-out, transform 0.1s ease-in-out;
                        display: flex;
                        /* Para centrar el ícono y texto si los hubiera */
                        align-items: center;
                        justify-content: center;
                        gap: 5px;
                    }

                    .submit-button-simple:hover {
                        background-color: #66aaff;
                        /* Un azul un poco más oscuro al pasar el cursor */
                        transform: translateY(-1px);
                        /* Efecto sutil de levantamiento */
                    }

                    .submit-button-simple:active {
                        transform: translateY(0);
                        /* Quita el efecto al hacer click */
                        background-color: #5599ee;
                    }
                </style>

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