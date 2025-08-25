@extends('instructor.inicio.layout')

{{-- Define la sección de la barra de navegación para el mensaje de bienvenida --}}
@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


{{-- Define el contenido principal de la página --}}
@section('content')

<main class="app-content">
    <div class="row mb-4 d-flex align-items-start">
        <div class="col-lg-8 mb-4">
            <div class="tile shadow-sm rounded-4">
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
                    <div class="list-group">
                        <p class="text-muted text-center p-3 mb-0">
                            Selecciona una fecha en el calendario para ver o agregar actividades.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="text-center" style="height: 100%;">
                <img src="{{ asset('assets/images/imagen.jpg') }}" alt="Deportes" class="img-fluid rounded-4" style="height: 100%; object-fit: cover;">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-4">
            <div class="tile shadow-sm rounded-4">
                <h5 class="mb-3"><i class="bi bi-bell me-2"></i>Últimas notificaciones</h5>
                <div class="list-group" id="notificationList">
                    {{-- **INICIO DEL CÓDIGO DE NOTIFICACIONES** --}}
                    @forelse ($asistenciasHoy as $asistencia)
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Asistencia guardada</h5>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</small>
                        </div>
                        <p class="mb-1">Se ha registrado la asistencia para el estudiante <strong>{{ $asistencia->estudiante->nombre_completo }}</strong> del subgrupo <strong>{{ $asistencia->subgrupo->nombre }}</strong> con estado **{{ $asistencia->estado }}**.</p>
                    </div>
                    @empty
                    <p class="text-center text-muted p-3">No hay asistencias registradas para hoy.</p>
                    @endforelse
                    {{-- **FIN DEL CÓDIGO DE NOTIFICACIONES** --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
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