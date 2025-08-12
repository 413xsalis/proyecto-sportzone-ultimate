@extends('colaborador.inscripcion_estudent.layout')

<! @section('content') <div class="container mt-5">
    <h3>Registrar Nuevo Instructor</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('instructores.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombres y Apellidos:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="documento" class="form-label">Documento:</label>
            <input type="text" name="documento" id="documento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control">
        </div>

        <div class="mb-3">
            <label for="especialidad" class="form-label">Especialidad:</label>
            <input type="text" name="especialidad" id="especialidad" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Registrar Instructor</button>

        <a href="{{ route('colab.principal') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    <br>
    </div>

@endsection