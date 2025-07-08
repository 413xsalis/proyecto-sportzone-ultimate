@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container mt-3">
    <h2>Editar Producto</h2>
    
    <form action="{{ route('usuario.update', $Users->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $Users->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $Users->email }}</textarea>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $Users->password }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('usuario.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection