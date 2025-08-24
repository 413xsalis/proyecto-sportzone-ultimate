{{-- PAGOS DE INSCRIPCIÓN --}}
@extends('colaborador.pagos.partials.layout')

@section('contenido')
<h4 class="mt-4 mb-3">Pagos de Inscripción</h4>

@if ($pagos->where('tipo', 'inscripción')->isEmpty())
    <div class="alert alert-info">No hay pagos de inscripción registrados.</div>
@else
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>#</th>
                    <th>Estudiante</th>
                    <th>Tipo</th>
                    <th>Mes / Año</th>
                    <th>Valor</th>
                    <th>Fecha de Pago</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pagos->where('tipo', 'inscripción') as $index => $pago)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $pago->estudiante->nombre ?? 'No asignado' }}</td>
                        <td class="text-center">{{ ucfirst($pago->tipo) }}</td>
                        <td class="text-center">{{ $pago->mes ?? '-' }} / {{ $pago->año ?? '-' }}</td>
                        <td class="text-end">${{ number_format($pago->valor, 0, ',', '.') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                        <td class="text-center">
                            @if ($pago->estado === 'pagado')
                                <span class="badge bg-success">Pagado</span>
                            @else
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este pago?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

{{-- PAGOS DE MENSUALIDAD --}}
<h4 class="mt-4 mb-3">Pagos de Mensualidad</h4>

@if ($pagos->where('tipo', 'mensualidad')->isEmpty())
    <div class="alert alert-info">No hay pagos de mensualidad registrados.</div>
@else
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-success text-center">
                <tr>
                    <th>#</th>
                    <th>Estudiante</th>
                    <th>Tipo</th>
                    <th>Mes / Año</th>
                    <th>Valor</th>
                    <th>Fecha de Pago</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pagos->where('tipo', 'mensualidad') as $index => $pago)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $pago->estudiante->nombre ?? 'No asignado' }}</td>
                        <td class="text-center">{{ ucfirst($pago->tipo) }}</td>
                        <td class="text-center">{{ $pago->mes ?? '-' }} / {{ $pago->año ?? '-' }}</td>
                        <td class="text-end">${{ number_format($pago->valor, 0, ',', '.') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                        <td class="text-center">
                            @if ($pago->estado === 'pagado')
                                <span class="badge bg-success">Pagado</span>
                            @else
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este pago?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
