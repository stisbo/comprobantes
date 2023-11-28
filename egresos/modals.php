<!-- Modal nuevo ingreso -->
<div class="modal fade" id="modal_egreso_nuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar nuevo ingreso</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form_nuevo">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputWithSuggestions" placeholder="Buscar elementos" value="">
            <label for="inputWithSuggestions">Motivo (concepto)</label>
            <div id="suggestions"></div>
          </div>
          <div class="form-floating mb-3">
            <input type="number" class="form-control" name="monto" placeholder="" value="">
            <label for="">Monto</label>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" id="afiliado" value="" placeholder="....">
            <label for="afiliado">Usuario o entidad referente</label>
            <input type="hidden" name="idUsuario" value="0">
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