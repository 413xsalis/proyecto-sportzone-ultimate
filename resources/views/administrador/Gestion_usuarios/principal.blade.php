@extends('administrador.Gestion_usuarios.layout')
@section('content')

    <main class="content">
        <div class="app-title">
            <div>
                <h1><i class="bi"></i> Gestion usuarios</h1>
                <p> Modulo Administrador</p>
            </div>
        </div>


        <div class="container mt-3">
            <!-- <div class="d-flex justify-content-between mb-1">
                <h2>Lista de Usuarios</h2>
                <a href="{{ route('admin.create') }}" class="btn btn-success">Nuevo Usuario</a>
            </div> -->


            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

<!-- resources/views/users/index.blade.php -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estado</th>
            <th width="280px">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Users as $usuario)
        <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>
                @if($usuario->trashed())
                    <span class="badge bg-danger">Inactivo</span>
                @else
                    <span class="badge bg-success">Activo</span>
                @endif
            </td>
            <td>
                @if($usuario->trashed())
                    <!-- Botón para restaurar -->
                    <form action="{{ route('usuario.restore', $usuario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="fas fa-undo"></i> Reactivar
                        </button>
                    </form>
                    
                    <!-- Botón para eliminar permanentemente -->
                    <form action="{{ route('usuario.force-delete', $usuario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                            onclick="return confirm('¿Estás seguro de ELIMINAR PERMANENTEMENTE este usuario?')">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                @else
                    <!-- Botón para editar -->
                    <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                                                    <a href="{{ route('usuarios.inactivos')}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> usuarios inactiv
                    </a>
                    
                    <!-- Botón para desactivar -->
                    <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" 
                            onclick="return confirm('¿Estás seguro de desactivar este usuario?')">
                            <i class="fas fa-trash-alt"></i> Desactivar
                        </button>
                    </form>
                    
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
  @endsection