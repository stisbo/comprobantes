<?php
interface iPapeleo {
}

class Usuario {
  public string $nombre;
  public string $apellido;
  public string $medioContacto;
  public string $email;
  public string $telefono;
  public string $direccion;
  public function __construct($nombre, $apellido) {
    $this->nombre = $nombre;
    $this->apellido = $apellido;
  }

  public function setDireccion($direccion) {
    $this->direccion = $direccion;
    return $this;
  }
  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }
  public function setTelefono($telefono) {
    $this->telefono = $telefono;
    return $this;
  }

  public function build() {
    return $this;
  }
}

$usuario = new Usuario('Pedro', 'Perez');
$usuario->setDireccion('Calle falsa 123')->setEmail('XXXXXXXXXXXXXXX')->setTelefono('123456789');
print_r($usuario);
echo '<br>';
$usuario->nombre = 'Putito';
print_r($usuario);
echo '<hr><p>'.$usuario->telefono.'</p>';
?>



<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>PAGINA PRINCIPAL</title>
  <link rel="stylesheet" href="assets/datatables/datatables.bootstrap5.min.css">
  <link href="css/styles.css" rel="stylesheet" />
  <script src="assets/fontawesome/fontawesome6.min.js"></script>
  <script src="assets/jquery/jquery.js"></script>
</head>

<body>
  <?php include("common/header.php"); ?>
  <div id="layoutSidenav"> <!-- contenedor -->
    <?php include("common/sidebar.php"); ?>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Ingresos</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Lista Ingresos</li>
          </ol>
        </div>

      </main>
    </div>
  </div><!-- fin contenedor -->

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/scripts.js"></script>
  <script src="assets/datatables/datatables.jquery.min.js"></script>
  <script src="assets/datatables/datatables.bootstrap5.min.js"></script>
</body>

</html>