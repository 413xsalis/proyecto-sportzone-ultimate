<!-- Modal del estudiante -->
<div class="modal fade" id="modal{{ $estudiante->documento }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalles del estudiante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>Documento:</strong> {{ $estudiante->documento }}</p>
        <p><strong>Telefono:</strong> {{ $estudiante->telefono }}</p>
        <p><strong>Email:</strong> {{ $estudiante->email ?? 'No disponible' }}</p>
        <p><strong>Contacto:</strong> {{ $estudiante->nombre_contacto }}</p>
        <p><strong>Contacto Telefono:</strong> {{ $estudiante->telefono_contacto }}</p>
      </div>
    </div>
  </div>
</div>