<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>INGRESOS</title>
  <link rel="stylesheet" href="../assets/datatables/datatables.bootstrap5.min.css">
  <link href="../css/styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/custom.css">
  <link rel="stylesheet" href="../assets/jquery/jqueryToast.min.css">
  <script src="../assets/fontawesome/fontawesome6.min.js"></script>
  <script src="../assets/jquery/jquery.js"></script>
  <script src="../assets/jquery/jqueryToast.min.js"></script>
  <style>
    #suggestions {
      display: none;
      border: 1px solid #ccc;
      max-height: 150px;
      overflow-y: auto;
    }

    #suggestions ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    #suggestions li {
      padding: 8px;
      cursor: pointer;
    }

    #suggestions li:hover {
      background-color: #f0f0f0;
    }
  </style>
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
            <h1>Ingresos</h1>
          </div>
          <div class="buttons-head col-md-6 col-sm-12 mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_ingreso_nuevo"><i class="fa fa-plus"></i> Crear Nuevo </button>
            <button class="btn btn-info" onclick="listaTodos()"><i class="fa fa-book"></i> Lista Todos</button>
            <button class="btn btn-warning" onclick="listaPendientes()"><i class="fa fa-info"></i> Pendientes</button>
            <button class="btn btn-primary" onclick="listaSaldados()"><i class="fa fa-check"></i> Saldados</button>
          </div>
          <div class="row" id="cards-ingresos">
            <div class="card mb-4 shadow">
              <div class="card-header">
                <h4>
                  <i class="fas fa-table me-1"></i>
                  Lista de ingresos
                </h4>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Fecha</th>
                      <th>Concepto</th>
                      <th>Monto</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
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