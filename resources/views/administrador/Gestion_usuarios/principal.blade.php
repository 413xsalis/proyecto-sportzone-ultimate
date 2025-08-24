@extends('administrador.Gestion_usuarios.layout')
@section('title', 'Gestión de Usuarios')
@section('content')
    <main class="content">
        <div class="container py-5">
            <div class="app-title">
                <div class="d-flex align-items-center">
                    @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
                        <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto de perfil"
                            class="profile-image-sidebar me-3">
                    @else
                        <div class="default-avatar default-avatar-sidebar me-3">
                            <i class="bi bi-person fs-4"></i>
                        </div>
                    @endif
                    <div>
                        <h1 class="mb-1"><i class="bi bi-people me-2"></i> Gesti&oacute;n de Usuarios</h1>
                        <p class="mb-0">Bienvenido/a, {{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stats-card stats-card-primary">
                        <p class="stats-number">{{ $totalUsers }}</p>
                        <p class="stats-label">Usuarios Totales</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card stats-card-success">
                        <p class="stats-number">{{ $activeUsers }}</p>
                        <p class="stats-label">Usuarios Activos</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card stats-card-danger">
                        <p class="stats-number">{{ $inactiveUsers }}</p>
                        <p class="stats-label">Usuarios Inactivos</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div
                    class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h5 class="mb-2 mb-md-0"><i class="bi bi-table me-2"></i> Lista de Usuarios</h5>
                    <div class="d-flex flex-column flex-md-row">
                        <div class="search-box me-md-2 mb-2 mb-md-0">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="Buscar usuario..." id="searchInput">
                        </div>
                        <a href="{{ route('usuario.trashed') }}" class="btn btn-warning">
                            <i class="bi bi-trash me-1"></i> Papelera ({{ $inactiveUsers }})
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="usersTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol(es)</th>
                                    <th>Estado</th>
                                    <th width="200px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $usuario)
                                    <tr>
                                        <td><strong>#{{ $usuario->id }}</strong></td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>
                                            @if($usuario->roles->count() > 0)
                                                @foreach($usuario->roles as $role)
                                                    @if($role->name == 'Administrador')
                                                        <span class="role-badge role-admin">{{ $role->name }}</span>
                                                    @elseif($role->name == 'Colaborador')
                                                        <span class="role-badge role-colab">{{ $role->name }}</span>
                                                    @elseif($role->name == 'Usuario')
                                                        <span class="role-badge role-user">{{ $role->name }}</span>
                                                    @else
                                                        <span class="role-badge role-other">{{ $role->name }}</span>
                                                    @endif
                                                @endforeach
                                            @else
                                                <span class="text-muted">Sin roles asignados</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($usuario->trashed())
                                                <span class="badge bg-danger">Inactivo</span>
                                            @else
                                                <span class="badge bg-success">Activo</span>
                                            @endif
                                        </td>
                                        <td class="action-buttons">
                                            <!-- Botón para editar -->
                                            <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-sm btn-primary"
                                                title="Editar usuario">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Botón para desactivar -->
                                            @if(!$usuario->trashed())
                                                <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Desactivar usuario"
                                                        onclick="return confirm('¿Estás seguro de desactivar este usuario?')">
                                                        <i class="fas fa-user-slash"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Botón para ver detalles -->
                                            <a href="#" class="btn btn-sm btn-info" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    @if($users->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted">
                                Mostrando {{ $users->firstItem() }} - {{ $users->lastItem() }} de {{ $users->total() }}
                                registros
                            </div>
                            <nav>
                                {{ $users->links() }}
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Búsqueda en tiempo real
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('usersTable');
            const rows = table.getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function () {
                const searchText = this.value.toLowerCase();

                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');
                    let found = false;

                    for (let j = 0; j < cells.length; j++) {
                        const cellText = cells[j].textContent.toLowerCase();
                        if (cellText.indexOf(searchText) > -1) {
                            found = true;
                            break;
                        }
                    }

                    if (found) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });

            // Tooltips para botones
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection