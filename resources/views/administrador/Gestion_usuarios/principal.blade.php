@extends('administrador.Gestion_usuarios.layout')

@section('content')


<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi"></i> Gestion usuarios</h1>
        </div>
    </div>
    <div class="container mt-3">
        <div class="d-flex justify-content-between mb-3">
            <h2>Lista de Usuarios</h2>
            <a href="{{ route('admin.create') }}" class="btn btn-success">Nuevo Usuario</a>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th width="280px">Acciones</th>
            </tr>
            @foreach ($Users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->password }}</td>
                <td>
                    <form action="{{ route('products.destroy', $user->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('products.show', $user->id) }}">Ver</a>
                        <a class="btn btn-primary" href="{{ route('products.edit', $user->id) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    @endsection