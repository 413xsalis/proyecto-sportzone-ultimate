<!-- Modal para asignar o ver actividad -->
<div class="modal fade" id="modalActividad" tabindex="-1" aria-labelledby="modalActividadLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalActividadLabel">Asignar Actividad</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form method="POST" action="{{ route('inst.horarios.guardar') }}">
                @csrf
                <div class="modal-body">
                    <!-- hidden horario_id -->
                    <input type="hidden" name="horario_id" id="modal-horario-id">

                    <!-- Subgrupo (select) -->
                    <div class="mb-3">
                        <label class="form-label">Subgrupo:</label>
                        <select name="subgrupo_id" id="modal-subgrupo" class="form-select" required>
                            <option value="">Selecciona un subgrupo</option>
                            @foreach($subgrupos as $sg)
                            <option value="{{ $sg->id }}">{{ $sg->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Clase / Actividad -->
                    <div class="mb-3">
                        <label class="form-label">Clase / Actividad:</label>
                        <input type="text" name="actividad" id="modal-clase" class="form-control" required>
                    </div>

                    <!-- Instructor (lectura) -->
                    <div class="mb-3">
                        <label class="form-label">Instructor:</label>
                        <input type="text" id="modal-instructor-display" class="form-control" readonly>
                        <!-- opcional: hidden para guardar si quieres: -->
                        <!-- <input type="hidden" name="instructor_id" id="modal-instructor-id"> -->
                    </div>

                    <!-- Estado -->
                    <div class="mb-3">
                        <label class="form-label">Estado:</label>
                        <select name="estado" id="modal-estado" class="form-select">
                            <option value="activo">Programada</option>
                            <option value="activo">Activo</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="cancelado">Cancelada</option>
                        </select>
                    </div>

                    <!-- Instructor oculto (si deseas enviar instructor_id explicitamente) -->
                    <!-- <input type="hidden" name="instructor_id" id="modal-instructor-id"> -->
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar Actividad</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>