<!-- Modal nuevo ingreso -->
<div class="modal fade" id="modal_usuario_nuevo" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-primary" role="alert">
          Crear un usuario y de acuerdo al<strong> rol </strong> podra editar y ver los proyectos.
        </div>
        <form id="form_nuevo_user">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="user_alias" placeholder="usuario" value="" name="alias">
            <label for="user_alias">Ingrese un usuario</label>
          </div>
          <div class="mb-2">
            <select class="form-select" name="rol">
              <option value="VISOR">VISOR</option>
              <option value="EDITOR">EDITOR</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_modal_user">Registrar suario</button>
      </div>
    </div>
  </div>
</div>