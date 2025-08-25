{{--@extends('layouts.app') {{-- Ajusta según tu layout principal -}}

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Pago</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Hay errores en el formulario.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pagos.pagos.update', $pago->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="tipo">Tipo de Pago</label>
            <input type="text" name="tipo" class="form-control" value="{{ $pago->tipo }}" readonly>
        </div>

        <div class="form-group mb-3">
            <label for="concepto">Concepto (opcional)</label>
            <input type="text" name="concepto" class="form-control" value="{{ $pago->concepto }}">
        </div>

        <div class="form-group mb-3">
            <label for="valor">Valor</label>
            <input type="number" name="valor" class="form-control" value="{{ $pago->valor }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="fecha_pago">Fecha de Pago</label>
            <input type="date" name="fecha_pago" class="form-control" value="{{ $pago->fecha_pago }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="medio_pago">Medio de Pago</label>
            <select name="medio_pago" class="form-control" required>
                <option value="efectivo" {{ $pago->medio_pago == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                <option value="nequi" {{ $pago->medio_pago == 'nequi' ? 'selected' : '' }}>Nequi</option>
                <option value="daviplata" {{ $pago->medio_pago == 'daviplata' ? 'selected' : '' }}>Daviplata</option>
                <option value="transferencia" {{ $pago->medio_pago == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control" required>
                <option value="Pagado" {{ $pago->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                <option value="Pendiente" {{ $pago->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="estudiante_documento">Estudiante</label>
            <select name="estudiante_documento" class="form-control" required>
                @foreach($estudiantes as $estudiante)
                    <option value="{{ $estudiante->documento }}"
                        {{ $pago->estudiante_documento == $estudiante->documento ? 'selected' : '' }}>
                        {{ $estudiante->nombre_1 }} {{ $estudiante->apellido_1 }} ({{ $estudiante->documento }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Pago</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection --}}

@extends('layouts.app') {{-- Ajusta según tu layout principal --}}

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg rounded">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-edit"></i> Editar Pago
                    </h4>
                    <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="card-body">
                    {{-- Mostrar errores --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong><i class="fas fa-exclamation-triangle"></i> Ups!</strong> Corrige los siguientes errores:
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pagos.pagos.update', $pago->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Tipo de Pago</label>
                            <input type="text" name="tipo" class="form-control" value="{{ $pago->tipo }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Concepto (opcional)</label>
                            <input type="text" name="concepto" class="form-control" value="{{ $pago->concepto }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Valor</label>
                            <input type="number" name="valor" class="form-control" value="{{ $pago->valor }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha de Pago</label>
                            <input type="date" name="fecha_pago" class="form-control" value="{{ $pago->fecha_pago }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Medio de Pago</label>
                            <select name="medio_pago" class="form-select" required>
                                <option value="efectivo" {{ $pago->medio_pago == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                <option value="nequi" {{ $pago->medio_pago == 'nequi' ? 'selected' : '' }}>Nequi</option>
                                <option value="daviplata" {{ $pago->medio_pago == 'daviplata' ? 'selected' : '' }}>Daviplata</option>
                                <option value="transferencia" {{ $pago->medio_pago == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select" required>
                                <option value="Pagado" {{ $pago->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                                <option value="Pendiente" {{ $pago->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estudiante</label>
                            <select name="estudiante_documento" class="form-select" required>
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->documento }}"
                                        {{ $pago->estudiante_documento == $estudiante->documento ? 'selected' : '' }}>
                                        {{ $estudiante->nombre_1 }} {{ $estudiante->apellido_1 }} ({{ $estudiante->documento }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success me-2">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

