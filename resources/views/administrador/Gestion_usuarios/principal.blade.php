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
             <div class="d-flex justify-content-between mb-1">
                <h2>Lista de Usuarios</h2>
                <a href="{{ route('admin.users.active') }}" class="btn btn-success">Nuevo Usuario</a>
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
                @foreach ($Users as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->password }}</td>
                        <td>
                            <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('usuario.show', $usuario->id) }}">Ver</a>
                                <a class="btn btn-primary" href="{{ route('usuario.edit', $usuario->id) }}">Editar</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="app.js"></script>
    </main>
@endsection