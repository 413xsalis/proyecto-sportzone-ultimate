{{-- Tabla de datos --}}
<div class="table-responsive">
    <table id="tabla-asistencias" class="table table-bordered table-hover text-center align-middle">
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Documento</th>
                <th>Grupo</th>
                <th>Subgrupo</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($asistencias as $asis)
            <tr>
                <td>{{ $asis->estudiante->nombre_completo ?? 'N/A' }}</td>
                <td>{{ $asis->estudiante->documento ?? 'N/A' }}</td>
                <td>{{ $asis->subgrupo->grupo->nombre ?? 'N/A' }}</td>
                <td>{{ substr($asis->subgrupo->nombre ?? 'N/A', -1) }}</td>
                <td>{{ $asis->fecha }}</td>
                <td>
                    <span class="badge {{ $asis->estado == 'Presente' ? 'bg-success' : 'bg-danger' }}">
                        {{ $asis->estado }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No hay registros de asistencia para mostrar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Formulario para exportar PDF (solo si hay datos filtrados) --}}
@if($asistencias->isNotEmpty() && request('subgrupo_id') && request('fecha'))
<div class="d-flex justify-content-end mb-3">
    <form action="{{ route('inst.reporte.asistencias.pdf') }}" method="POST">
        @csrf
        {{-- Incluye los valores del formulario de filtro como campos ocultos --}}
        <input type="hidden" name="subgrupo_id" value="{{ request('subgrupo_id') }}">
        <input type="hidden" name="fecha" value="{{ request('fecha') }}">

        <button type="submit" class="btn btn-primary">
            Exportar PDF
        </button>
    </form>
</div>
@endif