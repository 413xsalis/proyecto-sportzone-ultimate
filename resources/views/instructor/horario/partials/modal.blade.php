{{--
  Este es el contenedor principal del modal.
  - `id="actividadModal"`: ID único que JavaScript usará para referenciar este modal.
--}}
<div class="modal fade" id="actividadModal" tabindex="-1" aria-labelledby="actividadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            {{-- Encabezado del modal --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="actividadModalLabel">Asignar Actividad</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            {{-- Cuerpo del modal que contiene los campos del formulario --}}
            <div class="modal-body">
                {{-- Campos ocultos para enviar datos al servidor. Estos se llenan con JavaScript cuando el usuario hace clic en una celda del horario. --}}
                <input type="hidden" id="dia" name="dia">
                <input type="hidden" id="hora" name="hora">
                <input type="hidden" id="horario_id" name="horario_id">

                {{-- Campo para seleccionar un subgrupo --}}
                <div class="mb-3">
                    <label for="subgrupo_id" class="form-label">Subgrupo:</label>
                    <select id="subgrupo_id" name="subgrupo_id" class="form-select" required>
                        <option value="">Seleccione un subgrupo</option>
                        {{-- Bucle de Blade para rellenar las opciones del selector con los subgrupos disponibles. Estos datos se pasan desde el controlador. --}}
                        @foreach($subgrupos as $sg)
                        <option value="{{ $sg->id }}">{{ $sg->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Campo para el nombre de la actividad --}}
                <div class="mb-3">
                    <label for="actividad" class="form-label">Clase / Actividad:</label>
                    <input type="text" class="form-control" id="actividad" name="actividad" required>
                </div>

                {{-- Campo para el estado de la actividad --}}
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select id="estado" name="estado" class="form-select" required>
                        <option value="pendiente">Pendiente</option>
                        <option value="activo">Activo</option>
                        <option value="cancelado">Cancelada</option>
                    </select>
                </div>
            </div>

            {{-- Pie de página del modal con los botones de acción --}}
            <div class="modal-footer">
                {{-- Botón para guardar los cambios. El atributo `id` se usa en JavaScript para escuchar el clic y enviar la información al servidor. --}}
                <button type="button" class="btn btn-success" id="guardarActividad">Guardar Actividad</button>
                {{-- Botón para cerrar el modal. El atributo `data-bs-dismiss="modal"` le dice a Bootstrap que lo cierre. --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>