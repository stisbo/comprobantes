<?php
if (isset($_COOKIE['user_obj'])) {
  $user = json_decode($_COOKIE['user_obj']);
} else {
  header('Location: ../auth/login.php');
  die();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>EGRESOS - PAGO</title>
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
          <div class="mt-4">
            <h1>Nuevo Egreso</h1>
          </div>
          <div class="buttons-head col-md-6 col-sm-12 mb-3">
            <button type="button" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Volver </button>
          </div>
          <div class="row" id="card-egresos">
            <form id="form_nuevo">  
              <div class="card shadow">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="tipo_detalle" placeholder="Tipo de detalle">
                        <label for="">Tipo de detalle</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="" placeholder="Descripcion">
                        <label for="">Concepto</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating mb-3">
                        <select name="modo_pago" id="" class="form-control">
                          <option value="">-- SELECCIONE --</option>
                          <option value="EFECTIVO">EFECTIVO</option>
                          <option value="CHEQUE">CHEQUE</option>
                          <option value="DEPOSITO">DEPOSITO</option>
                          <option value="GIRO">GIRO</option>
                          <option value="TARJETA">TARJETA</option>
                          <option value="BANCO">BANCO</option>
                        </select>
                        <label for="">Modo de pago</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="" placeholder="Usuario" value="<?=strtoupper($user->alias)?>" disabled >
                        <label for="">Pagado por:</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="" placeholder="Usuario destino">
                        <label for="">Recibido por:</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="" placeholder="fecha registro" value="<?=date('Y-m-d')?>" disabled>
                        <label for="">Fecha de registro</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                      <h4>¿Agregar un comprobante de pago?</h4>
                      <div class="d-flex gap-2">
                        <button type="button" class="btn btn-info"><i class="fa fa-image"></i></button>
                        <button type="button" class="btn btn-info"><i class="fa fa-signature"></i></button>
                        <button type="button" class="btn btn-info"><i class="fa fa-microphone"></i></button>
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="card-footer">
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success shadow">GUARDAR</button>
                  </div>
                </div>
              </div><!-- end card -->
            </form>
          </div>
        </div>
      </main>
    </div>
  </div><!-- fin contenedor -->

  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../js/scripts.js"></script>
  <script src="../assets/datatables/datatables.jquery.min.js"></script>
  <script src="../assets/datatables/datatables.bootstrap5.min.js"></script>
</body>

</html>