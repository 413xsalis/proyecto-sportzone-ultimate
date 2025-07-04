


<div class="container mt-4">
    <h2 class="mb-4">Generar Reporte de Inscripciones</h2>
    <form action="{{ route('reportes.inscripciones') }}" method="GET" class="row g-3">
        <div class="col-md-4">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
        </div>

        <div class="col-md-4">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
        </div>

        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary w-100">Generar PDF</button>
        </div>
    </form>
</div>
