<?php
if (isset($_COOKIE['user_obj'])) {
  $user = json_decode($_COOKIE['user_obj']);
} else {
  header('Location: ../auth/login.php');
  die();
}
require_once('../app/config/database.php');
require_once('../app/models/pago.php');
require_once('../app/models/proyecto.php');

use App\Models\Pago;
use App\Models\Proyecto;

if (!isset($_GET['proid'])) {
  header('Location: ./');
  die();
}
$proyecto = new Proyecto($_GET['proid']);
// print_r($proyecto);
$pagos = Pago::getByProject($proyecto->idProyecto);
// print_r($pagos);

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Pagos X proyecto</title>
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
      <main id="main_egresos">
        <div class="container-fluid px-4">
          <div class="mt-4 d-flex justify-content-between flex-wrap ">
            <h3>Pagos asociados a este proyecto</h3>
            <button class="btn btn-secondary float-end" type="button" onclick="history.back()"> Volver</button>
          </div>

          <div class="callout callout-primary shadow">
            <h4 class="text-uppercase">Proyecto: <?= $proyecto->proyecto ?></h4>
            <div class="d-flex justify-content-between align-items-center flex-wrap">
              <p class="fs-5 mb-1"><b>Monto de referencia: </b> <?= number_format($proyecto->montoRef, 2) ?></p>
              <p class="fs-5  mb-1"><b>Estado: </b> <?= $proyecto->estado ?></p>
            </div>
            <div>
              <p class="fs-5"><b>Fecha de creación: </b> <?= date('d/m/Y', strtotime($proyecto->fechaCreacion)) ?></p>
            </div>
          </div>

          <div class="row" id="card-egresos">
            <div class="card shadow">
              <div class="card-body">
                <div class="table-responsive">
                  <table style="width:100%" class="table table-hover" id="t_pagos">
                    <thead>
                      <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Detalle pago</th>
                        <th class="text-center">Monto</th>
                        <th class="text-center">Modo pago</th>
                        <th class="text-center">Fecha registro</th>
                        <th class="text-center">Pagado por</th>
                        <th class="text-center">Recibido por</th>
                        <th class="text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $suma = 0;
                      foreach ($pagos as $pago) :
                        // print_r($pago);
                      ?>
                        <tr class="text-center">
                          <td><?= $pago['idPago'] ?></td>
                          <td><?= $pago['concepto'] ?></td>
                          <td class="text-end"><?= number_format($pago['monto'], 2) ?></td>
                          <td><?= $pago['modoPago'] ?></td>
                          <td><?= date('d/m/Y', strtotime($pago['fechaRegistro'])) ?></td>
                          <td><?= $pago['usuario'] ?></td>
                          <td><?= $pago['afiliado'] ?></td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Opciones
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fa fa-pen text-primary"></i> Editar</a></li>
                                <?php if ($pago['namefile'] == '') : ?>
                                  <li><a class="dropdown-item" href="#" type="button"><i class="fa fa-plus text-success"></i> Agregar comprobante</a></li>
                                <?php else : ?>
                                  <li><a class="dropdown-item" href="#"><i class="fa fa-eye text-secondary"></i> Ver comprobante</a></li>
                                <?php endif; ?>
                              </ul>
                            </div>
                          </td>
                        </tr>
                      <?php
                        $suma += floatval($pago['monto']);
                      endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr class="table-light">
                        <td colspan="2" class="text-end fw-bolder">Suma: </td>
                        <td class="text-end"><?= number_format($suma, 2) ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tfoot>
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
  <script>
    $(document).ready(function() {
      $("#t_pagos").DataTable({
        language: lenguaje,
        info: false,
        scrollX: true,
        columnDefs: [{
          orderable: false,
          targets: [2, 4, 7]
        }],
      })
    })
  </script>
</body>

</html>