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
                        <button class="btn btn-sm btn-outline-primary me-1" id="prevMonth">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-primary" id="nextMonth">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="month" class="form-control" id="monthSelector">
                </div>
                <div class="mini-calendar">
                    <div class="calendar-header d-flex justify-content-between bg-light py-2 rounded-top">
                        <div class="text-center text-muted" style="width: 14.28%;">Lun</div>
                        <div class="text-center text-muted" style="width: 14.28%;">Mar</div>
                        <div class="text-center text-muted" style="width: 14.28%;">Mié</div>
                        <div class="text-center text-muted" style="width: 14.28%;">Jue</div>
                        <div class="text-center text-muted" style="width: 14.28%;">Vie</div>
                        <div class="text-center text-muted" style="width: 14.28%;">Sáb</div>
                        <div class="text-center text-muted" style="width: 14.28%;">Dom</div>
                    </div>
                    <div class="calendar-body" id="calendarBody">
                    </div>
                </div>
                <div class="mt-4" id="dailyEvents">
                    <h5 class="mb-3">Actividades para hoy</h5>
                    <div class="list-group"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="tile shadow-sm rounded-4 mb-4">
                <div class="d-flex justify-content-center mb-3">
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
            <p class="text-muted">© {{ date('Y') }} Todos los derechos reservados</p>
        </div>
    </div>
</main>

{{-- Enlaces a las bibliotecas de JavaScript necesarias --}}
<script src="{{ asset('assets/js/calendar.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
{{-- Enlace a tu archivo de JavaScript personalizado --}}
<script src="app.js"></script>
</main>
@endsection