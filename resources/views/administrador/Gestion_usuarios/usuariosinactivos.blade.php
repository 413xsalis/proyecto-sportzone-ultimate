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
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
            <h3>Usuarios Inactivos</h3>
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
                    @foreach ($inactiveUsers as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                <span class="badge bg-danger">Inactivo</span>
                            </td>
                            <td>
                                <form action="{{ route('usuario.restore', $usuario->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-undo"></i> Reactivar
                                    </button>
                                </form>

                                <form action="{{ route('usuario.force-delete', $usuario->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Estás seguro de ELIMINAR PERMANENTEMENTE este usuario?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection