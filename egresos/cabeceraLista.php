<div class="container-fluid px-4">
  <div class="mt-4">
    <h1>Egreso</h1>
  </div>
  <div class="buttons-head col-md-6 col-sm-12 mb-3">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_egreso_nuevo"><i class="fa fa-plus"></i> Crear Nuevo </button>
    <button class="btn btn-info" onclick="listar('all')"><i class="fa fa-book"></i> Lista Todos</button>
    <button class="btn btn-warning" onclick="listar('PENDIENTE')"><i class="fa fa-info"></i> Pendientes</button>
    <button class="btn btn-primary" onclick="listar('SALDADO')"><i class="fa fa-check"></i> Saldados</button>
  </div>
  <div class="row" id="card-egresos">
    <div class="card shadow">
      <div class="card-header">
        <h4>
          <i class="fa fa-table"></i> Lista todos los egresos
        </h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table style="width:100%" class="table table-hover" id="table_egresos">
            <thead>
              <tr>
                <th class="text-center">N° ID</th>
                <th class="text-center">Motivo</th>
                <th class="text-center">Usuario asociado</th>
                <th class="text-center">Fecha creacion</th>
                <th class="text-center">Creado por</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody id="t_body_egresos">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>