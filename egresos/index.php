<?php
if (isset($_COOKIE['user_obj'])) {
  $user = json_decode($_COOKIE['user_obj']);
} else {
  header('Location: ../auth/login.php');
  die();
} ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>EGRESOS</title>
  <link rel="stylesheet" href="../assets/datatables/datatables.bootstrap5.min.css">
  <link href="../css/styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/jquery/jqueryToast.min.css">
  <link rel="stylesheet" href="../css/custom.css">
  <script src="../assets/fontawesome/fontawesome6.min.js"></script>
  <script src="../assets/jquery/jquery.js"></script>
  <script src="../assets/jquery/jqueryToast.min.js"></script>
  <script src="../assets/sweetalert2/sweetalert2.all.min.js"></script>
</head>

<body>
  <?php include('./modals.php'); ?>
  <?php include("../common/header.php"); ?>
  <div id="layoutSidenav"> <!-- contenedor -->
    <?php include("../common/sidebar.php"); ?>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <div class="mt-4">
            <h1>Egreso</h1>
          </div>
          <div class="buttons-head col-md-6 col-sm-12 mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_egreso_nuevo"><i class="fa fa-plus"></i> Crear Nuevo </button>
            <button class="btn btn-info" onclick="listaTodos()"><i class="fa fa-book"></i> Lista Todos</button>
            <button class="btn btn-warning" onclick="listaPendientes()"><i class="fa fa-info"></i> Pendientes</button>
            <button class="btn btn-primary" onclick="listaSaldados()"><i class="fa fa-check"></i> Saldados</button>
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
                  <table class="table table-hover">
                    <thead>
                      <tr align="center">
                        <th>N°</th>
                        <th>Motivo</th>
                        <!-- <th>Cuenta egreso</th> -->
                        <th>Fecha egreso</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td align="center"><span class="badge text-bg-primary">PAGADO</span></td>
                        <td>Valor1</td>
                      </tr>
                      <tr>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td align="center"><span class="badge text-bg-warning">SIN DEUDA</span></td>
                        <td>Valor1</td>
                      </tr>
                      <tr>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                      </tr>
                      <tr>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                      </tr>
                      <tr>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                        <td>Valor1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div><!-- fin contenedor -->

  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../js/scripts.js"></script>
  <script src="../assets/datatables/datatables.jquery.min.js"></script>
  <script src="../assets/datatables/datatables.bootstrap5.min.js"></script>
  <script src="./js/app.js"></script>
</body>

</html>