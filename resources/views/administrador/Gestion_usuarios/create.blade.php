@extends('administrador.Gestion_usuarios.layout')


<! @section('content')
<div class="container mt-3">
    <h2>Crear Nuevo  Usuario</h2>
    
    <form action="{{ route('usuario.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.Gestion_usuarios') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div> 

@endsection