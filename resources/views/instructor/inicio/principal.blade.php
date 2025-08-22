@extends('instructor.inicio.layout')

{{-- Define la sección de la barra de navegación para el mensaje de bienvenida --}}
@section('nav-message')
    Bienvenido - Panel de control de instructores
@endsection


{{-- Define el contenido principal de la página --}}
@section('content')

    <main class="app-content">
        <div class="row mb-4">
            <div class="col-lg-8 mb-4">
                <div class="tile shadow-sm rounded-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="tile-title mb-0">Calendario de Actividades</h3>
                        <div>
                            {{-- Botones para navegar entre meses. `id` es usado por JavaScript. --}}
                            <button class="btn btn-sm btn-outline-primary me-1" id="prevMonth">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-primary" id="nextMonth">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        {{-- Muestra el mes y año actuales por defecto. `now()` es una función de Laravel. --}}
                        <input type="month" class="form-control" id="monthSelector" value="{{ now()->format('Y-m') }}">
                    </div>
                    <div class="mini-calendar">
                        <div class="calendar-header d-flex justify-content-between bg-light py-2 rounded-top">
                            {{-- Bucle para mostrar los nombres de los días de la semana --}}
                            @foreach(['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $day)
                                <div class="text-center text-muted" style="width: 14.28%;">{{ $day }}</div>
                            @endforeach
                        </div>
                        <div class="calendar-body">
                            {{-- Bucle para crear las 6 filas del calendario (semanas) --}}
                            @for($i = 0; $i < 6; $i++)
                                <div class="calendar-row d-flex">
                                    {{-- Bucle para crear las 7 celdas de cada día de la semana --}}
                                    @for($j = 0; $j < 7; $j++)
                                        {{-- Lógica PHP dentro del HTML para calcular y verificar el estado del día --}}
                                        @php
                                            $day = $i * 7 + $j + 1;
                                            $isToday = $day === (int) now()->format('d');
                                            $hasEvent = in_array($day, [5, 10, 15, 20, 25]);
                                        @endphp
                                        <div class="calendar-day text-center p-2 border" style="width: 14.28%; height: 60px; cursor: pointer;"
                                            data-day="{{ $day }}">
                                            <div class="d-flex flex-column h-100">
                                                {{-- Aplica la clase de fondo si es el día actual --}}
                                                <div
                                                    class="day-number {{ $isToday ? 'bg-primary text-white rounded-circle d-inline-block mx-auto' : '' }}"
                                                    style="width: 24px; height: 24px; line-height: 24px;">
                                                    {{ $day }}
                                                </div>
                                                {{-- Muestra un indicador si el día tiene un evento --}}
                                                @if($hasEvent)
                                                    <div class="event-indicator mt-auto">
                                                        <span class="badge bg-success rounded-pill" style="font-size: 6px;">●</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="mt-4" id="dailyEvents">
                        <h5 class="mb-3">Actividades para hoy</h5>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Fútbol juvenil</h6>
                                    <small>08:00 - 09:30</small>
                                </div>
                                <p class="mb-1">Cancha principal - Grupo A</p>
                                <small class="text-success"><i class="bi bi-check-circle"></i> Confirmado</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="tile shadow-sm rounded-4 mb-4">
                    <div class="d-flex justify-content-center mb-3">
                        {{-- Muestra una imagen desde la carpeta `public` de Laravel. --}}
                        <img src="{{ asset('assets/images/foto.jpg') }}" alt="Deporte" class="img-fluid rounded-4"
                            style="max-height: 220px; object-fit: cover;">
                    </div>
                    <div class="text-center">
                        <h5 class="mb-1">Próximo evento destacado</h5>
                        <p class="mb-0">Practica entre grupos A - B</p>
                        <p class="mb-0"><i class="bi bi-calendar-event"></i> 15 de Julio, 2024</p>
                        <button class="btn btn-sm btn-primary mt-2">Ver detalles</button>
                    </div>
                </div>
                <div class="tile shadow-sm rounded-4 p-3">
                    <h5 class="mb-3">Resumen de actividades</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <div class="text-center">
                            <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                            <div class="mt-1">Alumnos</div>
                            <strong>24</strong>
                        </div>
                        <div class="text-center">
                            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-calendar-check fs-4"></i>
                            </div>
                            <div class="mt-1">Clases/sem</div>
                            <strong>12</strong>
                        </div>
                        <div class="text-center">
                            <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="bi bi-trophy fs-4"></i>
                            </div>
                            <div class="mt-1">Eventos</div>
                            <strong>3</strong>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5 class="mb-3">Acciones rápidas</h5>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-start">
                                <i class="bi bi-plus-circle me-2"></i> Nueva actividad
                            </button>
                            <button class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-start">
                                <i class="bi bi-person-plus me-2"></i> Agregar alumno
                            </button>
                            <button class="btn btn-outline-info btn-sm d-flex align-items-center justify-content-start">
                                <i class="bi bi-calendar-plus me-2"></i> Programar evento
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tile shadow-sm rounded-4">
                    <h5 class="mb-3"><i class="bi bi-bell me-2"></i>Últimas notificaciones</h5>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div
                                    class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 40px; height: 40px;">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Nuevo alumno inscrito</h6>
                                    <small class="text-muted">Carlos Mendoza se ha inscrito en fútbol juvenil</small>
                                </div>
                                <small class="ms-auto text-muted">Hace 2 horas</small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div
                                    class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 40px; height: 40px;">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Evento próximo</h6>
                                    <small class="text-muted">Torneo de futbol este sábado</small>
                                </div>
                                <small class="ms-auto text-muted">Ayer</small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center">
                                <div
                                    class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 40px; height: 40px;">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Recordatorio de activacion</h6>
                                    <small class="text-muted">5 alumnos para agregar a la lista</small>
                                </div>
                                <small class="ms-auto text-muted">Hace 2 días</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h5>SportZone</h5>
                <p class="text-muted">Sistema de gestión para escuelas deportivas</p>
                <div class="d-flex">
                    <a href="#" class="me-3 text-muted"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="me-3 text-muted"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="me-3 text-muted"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-md-8 text-md-end">
                <h5>Contacto</h5>
                <p class="text-muted mb-0">
                    <i class="bi bi-envelope me-2"></i> info@sportzone.edu
                </p>
                <p class="text-muted mb-0">
                    <i class="bi bi-telephone me-2"></i> +57 123 456 7890
                </p>
                <p class="text-muted mb-0">v1.0.0</p>
                {{-- Muestra el año actual de forma dinámica con PHP --}}
                <p class="text-muted">© {{ date('Y') }} Todos los derechos reservados</p>
            </div>
        </div>
    </main>

    {{-- Enlaces a las bibliotecas de JavaScript necesarias --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Enlace a tu archivo de JavaScript personalizado --}}
    <script src="app.js"></script>
    </main>
@endsection