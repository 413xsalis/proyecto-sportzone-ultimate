@extends('colaborador.inicio_colab.layout')

@section('content')
<main class="content">
    <div class="container py-5">
        
        <!-- Encabezado -->
        <div class="d-flex align-items-center mb-4">
            @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
                <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" 
                     alt="Foto de perfil"
                     class="rounded-circle border shadow-sm me-3"
                     width="60" height="60">
            @else
                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center me-3" style="width:60px; height:60px;">
                    <i class="bi bi-person fs-4 text-secondary"></i>
                </div>
            @endif
            <div>
                <h1 class="h3 mb-1 fw-bold"><i class="bi bi-people me-2"></i> Gestión de Instructores</h1>
                <p class="text-muted mb-0">Bienvenido/a, {{ Auth::user()->name }}</p>
            </div>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Card de lista -->
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center p-3 border-bottom">
                <h5 class="mb-2 mb-md-0 fw-semibold"><i class="bi bi-table me-2"></i> Lista de Instructores</h5>
                <div class="d-flex flex-column flex-md-row">
                    <div class="position-relative me-md-2 mb-2 mb-md-0">
                        <input type="text" class="form-control ps-5" placeholder="Buscar instructor..." id="searchInput">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    </div>
                    <a href="{{ route('usuario.create') }}?rol=Instructor" class="btn btn-success shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Nuevo Instructor
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if($instructores->isEmpty())
                <!-- Estado vacío -->
                <div class="text-center py-5">
                    <i class="bi bi-person-x fs-1 text-muted"></i>
                    <h3 class="mt-3">No hay instructores registrados</h3>
                    <p class="text-muted">Comienza agregando un nuevo instructor al sistema.</p>
                    <a href="{{ route('usuario.create') }}?rol=Instructor" class="btn btn-success mt-3 shadow-sm">
                        <i class="bi bi-plus-circle"></i> Agregar Instructor
                    </a>
                </div>
                @else
                <!-- Tabla de instructores -->
                <div class="table-responsive">
                    <table class="table align-middle table-hover" id="instructoresTable">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th class="text-center" width="180px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instructores as $instructor)
                            <tr>
                                <td><span class="fw-semibold">#{{ $instructor->id }}</span></td>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->documento_identidad }}</td>
                                <td>{{ $instructor->telefono }}</td>
                                <td>{{ $instructor->email }}</td>
                                <td>
                                    @if($instructor->deleted_at)
                                        <span class="badge bg-danger rounded-pill">Inactivo</span>
                                    @else
                                        <span class="badge bg-success rounded-pill">Activo</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('usuario.edit', $instructor->id) }}" 
                                       class="btn btn-sm btn-primary me-1 shadow-sm" 
                                       title="Editar">
                                       <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ route('usuario.show', $instructor->id) }}" 
                                       class="btn btn-sm btn-info me-1 shadow-sm text-white" 
                                       title="Ver detalles">
                                       <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('usuario.destroy', $instructor->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" 
                                            onclick="return confirm('¿Seguro que deseas eliminar este instructor?')" 
                                            title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('instructoresTable');
        if (table) {
            const rows = table.getElementsByTagName('tr');
            searchInput.addEventListener('keyup', function () {
                const searchText = this.value.toLowerCase();
                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');
                    let found = false;
                    for (let j = 0; j < cells.length; j++) {
                        if (cells[j].textContent.toLowerCase().includes(searchText)) {
                            found = true; break;
                        }
                    }
                    row.style.display = found ? '' : 'none';
                }
            });
        }
    });
</script>
@endsection
