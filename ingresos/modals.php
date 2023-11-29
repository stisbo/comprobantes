<!-- Modal nuevo ingreso -->
<div class="modal fade" id="modal_ingreso_nuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar nuevo ingreso</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form_nuevo">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com" value="test@example.com">
            <label for="floatingInputValue">Input with value</label>
          </div>
          <div class="form-floating">
            <input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com" value="test@example.com">
            <label for="floatingInputValue">Input with value</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputWithSuggestions" placeholder="Buscar elementos" value="">
            <label for="floatingInputValue">Buscar Elementos</label>
            <div id="suggestions" class="suggestions"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>