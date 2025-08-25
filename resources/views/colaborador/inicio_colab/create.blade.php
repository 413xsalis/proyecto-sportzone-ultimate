@extends('colaborador.inscripcion_estudent.layout')

@section('content')
<div class="container mt-5">
    <h3>Registrar Nuevo Instructor</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('instructores.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres:</label>
            <input type="text" name="nombres" id="nombres" class="form-control"
                value="{{ old('nombres', $instructor->nombres ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control"
                value="{{ old('apellidos', $instructor->apellidos ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="documento" class="form-label">Documento:</label>
            <input type="text" name="documento" id="documento" class="form-control"
                value="{{ old('documento', $instructor->documento ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control"
                value="{{ old('telefono', $instructor->telefono ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" name="email" id="email" class="form-control"
                value="{{ old('email', $instructor->email ?? '') }}" required>
        </div>


        <button type="submit" class="btn btn-success">Registrar Instructor</button>
        <a href="{{ route('colab.principal') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    <br>
</div>
@endsection
