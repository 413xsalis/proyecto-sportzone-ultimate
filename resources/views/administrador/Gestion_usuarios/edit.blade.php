@extends('administrador.Gestion_usuarios.layout')

@section('title', 'Editar Usuario')

@section('content')
    <div class="container mt-3">
        <h2>Editar Usuario</h2>

        <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $usuario->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo:</label>
                <textarea class="form-control" id="email" name="email" rows="3" required>{{ $usuario->email }}</textarea>
            </div>
            <div class="form-group">
                <label for="roles">Editar Roles</label>
                <select name="roles[]" id="roles" class="form-control" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{-- Usamos $usuario->hasRole() de Spatie para verificar si el rol
                            está asignado --}}
                            {{ $usuario->hasRole($role->name) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('roles')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('usuario.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection