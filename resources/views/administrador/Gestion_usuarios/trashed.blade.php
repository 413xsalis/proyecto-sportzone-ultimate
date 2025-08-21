@extends('administrador.Gestion_usuarios.layout')

@section('content')
<div class="container">
    <h1>Papelera de Usuarios</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('usuario.index') }}" class="btn btn-primary mb-3">
        Volver a usuarios
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Eliminado el</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->deleted_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('usuario.restore', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Restaurar</button>
                    </form>
                    
                    <form action="{{ route('usuario.forceDelete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('¿Eliminar permanentemente?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection