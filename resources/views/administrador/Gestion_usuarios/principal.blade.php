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
        <a href="{{ route('usuario.trashed') }}" class="btn btn-secondary mb-3">
            Ver papelera ({{ \App\Models\User::onlyTrashed()->count() }})
        </a>

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
                @foreach ($users as $usuario)
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

                        <!-- Botón para editar -->
                        <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Editar
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

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
@endsection