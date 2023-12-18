<!-- Modal Eliminar pago -->
<div class="modal fade" id="modal_delete_pago" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar el pago</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="idPago_delete" id="idPago_delete" value="0">
        <div class="mb-2">
          <p class="fs-4">
            ¿Está seguro que desea eliminar el pago?
          </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="deeletePago()">Sí, eliminar</button>
      </div>
    </div>
  </div>
</div>