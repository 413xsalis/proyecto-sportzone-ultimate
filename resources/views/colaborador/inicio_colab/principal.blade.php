@extends('colaborador.inicio_colab.layout')

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
                    <h1 class="mb-1"><i class="bi bi-people me-2"></i> Gesti&oacute;n de Instructores</h1>
                    <p class="mb-0">Bienvenido/a, {{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h5 class="mb-2 mb-md-0"><i class="bi bi-table me-2"></i> Lista de Instructores</h5>
                <div class="d-flex flex-column flex-md-row">
                    <div class="search-box me-md-2 mb-2 mb-md-0">
                        <i class="bi bi-search"></i>
                        <input type="text" class="form-control" placeholder="Buscar instructor..." id="searchInput">
                    </div>
                    <a href="{{ route('usuario.create') }}?rol=Instructor" class="btn btn-success me-2">
                        <i class="bi bi-plus-circle me-1"></i> Nuevo Instructor
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($instructores->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-person-x"></i>
                    <h3>No hay instructores registrados</h3>
                    <p>Comienza agregando un nuevo instructor al sistema.</p>
                    <a href="{{ route('usuario.create') }}?rol=Instructor" class="btn btn-success mt-3">
                        <i class="bi bi-plus-circle"></i> Agregar Instructor
                    </a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover" id="instructoresTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Correo Electrónico</th>
                                <th>Estado</th>
                                <th width="200px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instructores as $instructor)
                            <tr>
                                <td><strong>#{{ $instructor->id }}</strong></td>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->documento_identidad }}</td>
                                <td>{{ $instructor->telefono }}</td>
                                <td>{{ $instructor->email }}</td>
                                <td>
                                    @if($instructor->deleted_at)
                                        <span class="badge bg-danger">Inactivo</span>
                                    @else
                                        <span class="badge bg-success">Activo</span>
                                    @endif
                                </td>
                                <td class="action-buttons">
                                    <!-- Botón para editar -->


                                    <!-- Botón para ver detalles -->

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                <!-- Paginación - SOLO si hay páginas -->
                @if($instructores->all())
                <div class="d-flex justify-content-between align-items-center mt-3">

                </div>
                @endif
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Búsqueda en tiempo real
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
        }
    });
</script>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
  </main>
@endsection