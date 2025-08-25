@extends('colaborador.pagos.partials.layout')

@section('contenido')
<div class="container mt-4">
    <h2>Registro de Mensualidades</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pagos.mensualidades.store') }}" method="POST">
         @csrf
    <input type="hidden" name="tipo" value="mensualidad">

        <div class="mb-3">
            <label>Estudiante:</label>
            <select name="estudiante_documento" class="form-select" required>
                <option value="">Seleccione un estudiante</option>
                @foreach($estudiantes as $estudiante)
                    <option value="{{ $estudiante->documento }}">
                        {{ $estudiante->nombre_1 }} {{ $estudiante->apellido_1 }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label>Valor ($):</label>
            <input type="number" name="valor" class="form-control" required>
        </div> 

        <div class="mb-3">
            <label for="concepto" class="form-label">Concepto</label>
            <input type="text" name="concepto" id="concepto" class="form-control" required>
        </div>


        <div class="mb-3">
            <label>Fecha de Pago:</label>
            <input type="date" name="fecha_pago" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Medio de Pago:</label>
            <select name="medio_pago" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="efectivo">Efectivo</option>
                <option value="nequi">Nequi</option>
                <option value="daviplata">Daviplata</option>
                <option value="transferencia">Transferencia a cuenta bancaria</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Mensualidad</button>
    </form>
</div>

    {{-- LISTADO --}}
@if($pagos->count() > 0)
    <div class="card mt-4">
        <div class="card-header">Pagos de Mensualidades Registrados</div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover m-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Estudiante</th>
                        
                        <th class="text-center">Fecha de pago</th>
                        <th class="text-end">Valor</th>
                        <th class="text-center">Medio de pago</th>
                        <th>Concepto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pagos as $index => $pago)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $pago->estudiante->nombre_1 ?? 'No asignado' }} {{ $pago->estudiante->apellido_1 ?? '' }}</td>
                            
                            <td class="text-center">{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                            <td class="text-end">${{ number_format($pago->valor, 0, ',', '.') }}</td>
                            <td class="text-center">{{ ucfirst($pago->medio_pago) }}</td>
                            <td>{{ $pago->concepto }}</td>
                            
                            <td>
                                <!-- Botón Editar -->
                                <a href="{{ route('pagos.pagos.edit', $pago->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('pagos.pagos.destroy', $pago->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este pago?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <p class="mt-4">No hay pagos registrados.</p>
@endif

@endsection
