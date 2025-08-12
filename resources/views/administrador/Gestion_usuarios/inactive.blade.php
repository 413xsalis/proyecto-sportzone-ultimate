@extends('administrador.Gestion_usuarios.layout')

@section('content')
<div class="container">
    <h2 class="my-4">Usuarios Inactivos</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->deleted_at)
                            <span class="badge bg-danger">Eliminado</span>
                        @else
                            <span class="badge bg-warning text-dark">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        @if(!$user->deleted_at)
                        <form action="{{ route('admin.users.activate', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi bi-person-check"></i> Activar
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection