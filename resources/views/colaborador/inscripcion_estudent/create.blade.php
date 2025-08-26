@extends('colaborador.inscripcion_estudent.layout')


@section('content')
< @section('title', 'Crear estudiante') 

<! @section('content')
 <div class="col-md-12 mb-4">
      <h2>Formulario de Inscripción</h2>
      <form action="{{ route('estudiantes.store') }}" method="POST">
      @csrf
      <br>
      <div class="row">
        <div class="col-md-6 mb-3">
        <label for="documento" class="form-label">Documento</label>
        <input type="number" class="form-control" name="documento" id="documento" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="nombre_1" class="form-label">Nombre 1</label>
        <input type="text" class="form-control" name="nombre_1" id="nombre_1" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="nombre_2" class="form-label">Nombre_2</label>
        <input type="text" class="form-control" name="nombre_2" id="nombre_2" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="apellido_1" class="form-label">Apellido_1</label>
        <input type="text" class="form-control" name="apellido_1" id="apellido_1" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="apellido_2" class="form-label">Apellido_2</label>
        <input type="text" class="form-control" name="apellido_2" id="apellido_2" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="telefono" class="form-label">Telefono</label>
        <input type="number" class="form-control" name="telefono" id="telefono" required>
        </div>

        <div class="form-group col-md-6">
    <label for="nombre_contacto">Nombre de Contacto</label>
    <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" value="{{ old('nombre_contacto') }}">
</div>


        <div class="col-md-6 mb-3">
        <label for="nombre_contacto" class="form-label">Telefono de Contacto</label>
        <input type="number" class="form-control" name="telefono_contacto" id="telefono_contacto" required>
        </div>

        <div class="col-md-6 mb-3">
        <label for="eps" class="form-lebel">EPS</label>
        <input type="text" class="form-control" name="eps" id="eps">
        </div>

      <div class="mb-3">
        <label for="grupo_id" class="form-label">Grupo</label>
        <select name="grupo_id" id="grupo_id" class="form-select" required>
          <option value="" disabled selected>-- Selecciona un grupo --</option>
          @foreach ($grupos as $grupo)
            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
          @endforeach
        </select>
      </div>
      </div>

      <button type="submit" class="btn btn-success">Registrar</button>
              <a href="{{ route('colab.inscripcion') }}" class="btn btn-secondary">Cancelar</a>
      </form>
      <br>
    </div>

@endsection