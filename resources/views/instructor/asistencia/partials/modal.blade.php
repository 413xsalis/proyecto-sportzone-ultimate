<!-- Modal de información del estudiante -->
<div class="modal fade" id="infoModal{{ $estudiante->id }}" tabindex="-1" aria-labelledby="infoModalLabel{{ $estudiante->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel{{ $estudiante->id }}">Información del estudiante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p><strong>Documento:</strong> {{ $estudiante->documento }}</p>
        <p><strong>Teléfono:</strong> {{ $estudiante->telefono }}</p>
        <p><strong>Acudiente:</strong> {{ $estudiante->acudiente }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>