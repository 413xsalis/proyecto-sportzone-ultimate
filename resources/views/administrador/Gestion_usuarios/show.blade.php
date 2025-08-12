@extends('administrador.Gestion_usuarios.layout')

@section('title', 'Detalle de Producto')

@section('content')
    <div class="container mt-3">
        <h2>Detalle del Producto</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $usuario->name }}</h5>
                <p class="card-text">{{ $usuario->email }}</p>
                <p class="card-text">{{ $usuario->password }}</p>

                <a href="{{ route('usuario.edit', $usuario) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('usuario.destroy', $usuario) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                <a href="{{ route('usuario.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection