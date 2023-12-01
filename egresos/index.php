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
      <main id="main_egresos">

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