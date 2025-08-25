@extends('colaborador.pagos.partials.layout')

@section('contenido')
<div class="container mt-4">

    <h2 class="mb-4">Pagos de Inscripción</h2>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FORMULARIO --}}
    
    <div class="card mb-4">
        <div class="card-header">Registrar pago de inscripción</div>
        <div class="card-body">
            <form action="{{ route('pagos.inscripciones.store') }}" method="POST">
                @csrf
                 {{-- Campos ocultos --}}
        <input type="hidden" name="tipo" value="inscripción">
        <input type="hidden" name="concepto" value="Pago de inscripción">
        <input type="hidden" name="estado" value="pagado">

                <div class="mb-3">
                    <label for="estudiante_documento" class="form-label">Estudiante</label>
                    <select name="estudiante_documento" id="estudiante_documento" class="form-select" required>
                        <option value="">Seleccione un estudiante</option>
                        @foreach($estudiantes as $estudiante)
                            <option value="{{ $estudiante->documento }}">
                                {{ $estudiante->nombre_1 }} {{ $estudiante->apellido_1 }} ({{ $estudiante->documento }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fecha_pago" class="form-label">Fecha de pago</label>
                    <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="valor" class="form-label">Valor ($)</label>
                    <input type="number" name="valor" id="valor" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="medio_pago" class="form-label">Medio de pago</label>
                    <select name="medio_pago" id="medio_pago" class="form-select" required>
                        <option value="">Seleccione una opción</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="nequi">Nequi</option>
                        <option value="daviplata">Daviplata</option>
                        <option value="transferencia">Transferencia bancaria</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Registrar pago</button>
            </form>
        </div>
    </div>

    {{-- LISTADO --}}
    
    <div class="card">
        <div class="card-header">Pagos registrados</div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover m-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Estudiante</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-end">Valor</th>
                        <th class="text-center">Medio de pago</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pagos as $index => $pago)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $pago->estudiante->nombre_1 ?? 'No asignado' }} {{ $pago->estudiante->apellido_1 ?? '' }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                            <td class="text-end">${{ number_format($pago->valor, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $pago->medio_pago }}</td>

                            <td>
                            <!-- Botón Editar -->
                            <a href="{{ route('pagos.pagos.edit', $pago->id) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <!-- Botón Eliminar -->
                            <form action="{{ route('pagos.pagos.destroy', $pago->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                     onclick="return confirm('¿Seguro que deseas eliminar este pago?')">Eliminar
                                </button>
                            </form>
                        </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay pagos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
