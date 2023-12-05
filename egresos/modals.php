<!-- Modal nuevo ingreso -->
<div class="modal fade" id="modal_egreso_nuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Proyecto de tipo egreso</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form_egreso">
          <input type="hidden" name="idProyecto" id="idProyecto_egreso" value="0">
          <div class="form-floating mb-3">
            <input type="text" name="proyecto" class="form-control" id="descripcion_e" placeholder="Buscar elementos" value="" autocomplete="off">
            <label for="descripcion_e">Descripción</label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="monto_e" name="montoRef" placeholder="" value="" step="any">
            <label for="monto_e">Monto Ref:</label>
          </div>
          <div class="form-floating">
            <select class="form-select" id="estado_e" name="estado">

            </select>
            <label for="estado">Estado</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="egresoUp()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL PAGO -->
<div class="modal fade" id="modal_pago_nuevo" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Registrar pago para el proyecto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form_pago">
          <input type="hidden" name="idProyecto" id="idProyecto_pago">
          <div class="mb-3">
            <label>Motivo del proyecto</label>
            <input type="text" class="form-control" id="motivo_proyecto" readonly>
          </div>
          <div class="form-floating mt-2 mb-3">
            <input type="number" class="form-control" id="monto_pago" name="monto" placeholder="Monto del pago" value="">
            <label for="monto_pago">Monto del pago</label>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" id="afiliado" value="" placeholder="...." autocomplete="off">
            <label for="afiliado">Usuario o entidad referente</label>
            <input type="hidden" name="idUsuario" value="0">
            <div id="suggestions" class="suggestions"></div>
          </div>
          <div class="mt-3">
            <label class="p-2"><strong>¿Desea agregar un comprobante de pago?</strong></label>
            <div class="d-flex justify-content-around">
              <button type="button" class="btn btn-primary"><i class="fa fa-microphone"></i></button>
              <button type="button" class="btn btn-success"><i class="fa fa-image"></i></button>
              <button type="button" class="btn btn-secondary"><i class="fa fa-file-signature"></i></button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>