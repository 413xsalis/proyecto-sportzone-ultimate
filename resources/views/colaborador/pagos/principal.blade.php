
@extends('colaborador.pagos.partials.layout')

@section('contenido')
    <div class="container mt-4">
        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
            <h4 class="text-primary"><i class="bi bi-speedometer"></i> Bienvenido</h4>
            <small class="text-end text-primary">Módulo Colaborador</small>
        </div>    

        <h2 class="mb-4">Gestión de Pagos</h2>

        <div class="row">

    <div class="col-md-6 mb-3">
        <a href="{{ route('pagos.inscripciones.index') }}" 
           class="text-decoration-none">
            <div class="p-4 border rounded-3 shadow-sm d-flex justify-content-between align-items-center bg-light">
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-plus-fill me-3 text-success fs-3"></i>
                    <div>
                        <h5 class="mb-1 text-dark">Inscripciones</h5>
                        <small class="text-muted">Registrar y consultar pagos de inscripción</small>
                    </div>
                </div>
                <i class="bi bi-arrow-right-circle-fill text-primary fs-4"></i>
            </div>
        </a>
    </div>

    <div class="col-md-6 mb-3">
        <a href="{{ route('pagos.mensualidades') }}" 
           class="text-decoration-none">
            <div class="p-4 border rounded-3 shadow-sm d-flex justify-content-between align-items-center bg-light">
                <div class="d-flex align-items-center">
                    <i class="bi bi-calendar-check-fill me-3 text-warning fs-3"></i>
                    <div>
                        <h5 class="mb-1 text-dark">Mensualidades</h5>
                        <small class="text-muted">Registrar y consultar pagos mensuales</small>
                    </div>
                </div>
                <i class="bi bi-arrow-right-circle-fill text-primary fs-4"></i>
            </div>
        </a>
    </div>

</div>

    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection






