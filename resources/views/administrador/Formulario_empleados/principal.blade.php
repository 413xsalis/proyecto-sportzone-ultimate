@extends('administrador.Formulario_empleados.layout')
@section('content')

    <main class="content">
        <div class="app-title">
            <div>
                <h1><i class="bi"></i> Formulario de empleados </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">

            </ul>
        </div>

        <div class="container">
            <h2 class="my-4">Usuarios Activos</h2>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Useri as $usuar)
                            <tr>
                                <td>{{ $usuar->id }}</td>
                                <td>{{ $usuar->name }}</td>
                                <td>{{ $usuar->email }}</td>
                                <td>
                                    <span class="badge bg-success">Activo</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('admin.users.deactivate', $usuar->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                <i class="bi bi-person-x"></i> Desactivar
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.users.destroy', $usuar->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ms-2">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
@endsection