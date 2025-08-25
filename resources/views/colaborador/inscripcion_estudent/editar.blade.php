@extends('colaborador.inscripcion_estudent.layout')

@section('content')
<main class="content">
  <div class="app-title">
    <h2 class="text-center mb-4">Editar Estudiante</h2>

    <form action="{{ route('estudiantes.update', $estudiante->documento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label for="documento" class="form-label">Documento</label>
                <input type="number" name="documento" class="form-control" value="{{ old('documento', $estudiante->documento) }}" required>
            </div>

            <div class="col-md-6">
                <label for="nombre_1" class="form-label">Primer Nombre</label>
                <input type="text" name="nombre_1" class="form-control" value="{{ old('nombre_1', $estudiante->nombre_1) }}" required>
            </div>

            <div class="col-md-6">
                <label for="nombre_2" class="form-label">Segundo Nombre</label>
                <input type="text" name="nombre_2" class="form-control" value="{{ old('nombre_2', $estudiante->nombre_2) }}">
            </div>

            <div class="col-md-6">
                <label for="apellido_1" class="form-label">Primer Apellido</label>
                <input type="text" name="apellido_1" class="form-control" value="{{ old('apellido_1', $estudiante->apellido_1) }}" required>
            </div>

            <div class="col-md-6">
                <label for="apellido_2" class="form-label">Segundo Apellido</label>
                <input type="text" name="apellido_2" class="form-control" value="{{ old('apellido_2', $estudiante->apellido_2) }}">
            </div>

            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $estudiante->telefono) }}">
            </div>

            <div class="col-md-6">
                <label for="nombre_contacto" class="form-label">Nombre de Contacto</label>
                <input type="text" name="nombre_contacto" class="form-control" value="{{ old('nombre_contacto', $estudiante->nombre_contacto) }}">
            </div>

            <div class="col-md-6">
                <label for="telefono_contacto" class="form-label">Teléfono de Contacto</label>
                <input type="text" name="telefono_contacto" class="form-control" value="{{ old('telefono_contacto', $estudiante->telefono_contacto) }}">
            </div>

            <div class="col-md-6">
                <label for="eps" class="form-label">EPS</label>
                <input type="text" name="eps" class="form-control" value="{{ old('eps', $estudiante->eps) }}">
            </div>

            <div class="col-md-6">
                <label for="id_grupo_nivel" class="form-label">Grupo o Nivel</label>
                <select name="id_grupo_nivel" class="form-select">
                    <option value="1" {{ $estudiante->id_grupo_nivel == 1 ? 'selected' : '' }}>Nivel 1</option>
                    <option value="2" {{ $estudiante->id_grupo_nivel == 2 ? 'selected' : '' }}>Nivel 2</option>
                    <option value="3" {{ $estudiante->id_grupo_nivel == 3 ? 'selected' : '' }}>Nivel 3</option>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
  </div>
</main>
@endsection 
