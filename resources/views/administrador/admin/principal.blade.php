@extends('administrador.admin.layout')
@section('title', 'Panel de Administración - SportZone')
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
                        <h1 class="mb-1"><i class="bi bi-people me-2"></i>Panel de Administración</h1>
                        <p class="mb-0">Bienvenido/a, {{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Tarjetas de estadísticas -->
            <div class="row mb-4">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total de Alumnos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAlumnos }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Entrenadores Activos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalInstructores }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-person-badge fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Clases Programadas Hoy</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $clasesHoyCount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-calendar-event fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accesos rápidos -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Accesos Rápidos</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-6 text-center mb-3">
                                    <a href="{{ route('usuario.index') }}" class="btn btn-light btn-icon-split p-3">
                                        <span class="icon text-gray-600">
                                            <i class="bi bi-people-fill fa-2x"></i>
                                        </span>
                                        <span class="text d-block mt-2">Gestión de Usuarios</span>
                                    </a>
                                </div>
                                <div class="col-md-3 col-6 text-center mb-3">
                                    <a href="#" class="btn btn-light btn-icon-split p-3">
                                        <span class="icon text-gray-600">
                                            <i class="bi bi-calendar-event fa-2x"></i>
                                        </span>
                                        <span class="text d-block mt-2">Gestión de Clases</span>
                                    </a>
                                </div>
                                <div class="col-md-3 col-6 text-center mb-3">
                                    <a href="#" class="btn btn-light btn-icon-split p-3">
                                        <span class="icon text-gray-600">
                                            <i class="bi bi-person-badge fa-2x"></i>
                                        </span>
                                        <span class="text d-block mt-2">Entrenadores</span>
                                    </a>
                                </div>
                                <div class="col-md-3 col-6 text-center mb-3">
                                    <a href="#" class="btn btn-light btn-icon-split p-3">
                                        <span class="icon text-gray-600">
                                            <i class="bi bi-people fa-2x"></i>
                                        </span>
                                        <span class="text d-block mt-2">Estudiantes</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Próximas clases -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Próximas Clases Hoy</h6>
                        </div>
                        <div class="card-body">
                            @if($clasesHoy->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Hora</th>
                                                <th>Clase</th>
                                                <th>Entrenador</th>
                                                <th>Duración</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($clasesHoy as $clase)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($clase->hora_inicio)->format('h:i A') }}</td>
                                                    <td>{{ $clase->grupo->nombre ?? 'Sin especificar' }}</td>
                                                    <td>{{ $clase->instructor->nombre ?? 'Sin asignar' }}</td>
                                                    <td>
                                                        @php
                                                            $inicio = \Carbon\Carbon::parse($clase->hora_inicio);
                                                            $fin = \Carbon\Carbon::parse($clase->hora_fin);
                                                            $duracion = $inicio->diff($fin)->format('%H:%I');
                                                        @endphp
                                                        {{ $duracion }} horas
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    No hay clases programadas para hoy.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de instructores -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Nuestros Entrenadores</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($instructores as $instructor)
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body text-center">
                                                <div class="mb-3">
                                                    <i class="bi bi-person-circle fa-3x text-gray-300"></i>
                                                </div>
                                                <h5 class="card-title">{{ $instructor->nombre }}</h5>
                                                <p class="card-text text-muted">{{ $instructor->especialidad }}</p>
                                                <p class="card-text small">
                                                    <i class="bi bi-telephone me-1"></i> {{ $instructor->telefono }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <style>
        .app-title {
            background: linear-gradient(135deg, #4e73df, #6f42c1);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .profile-image-sidebar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .default-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #6c757d;
            color: white;
            border-radius: 50%;
        }

        .default-avatar-sidebar {
            width: 60px;
            height: 60px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }

        .border-left-success {
            border-left: 4px solid #1cc88a !important;
        }

        .border-left-info {
            border-left: 4px solid #36b9cc !important;
        }

        .btn-icon-split {
            display: block;
            transition: all 0.3s;
            border-radius: 8px;
        }

        .btn-icon-split:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            text-decoration: none;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
@endsection