<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
        <div class="sb-sidenav-menu-heading">Core</div>
        <a class="nav-link" href="../dash/">
          <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
          MENU INICIO
        </a>
        <div class="sb-sidenav-menu-heading">ACCIONES</div>
        <a class="nav-link" id="nav-id-ingresos" href="../ingresos/">
          <div class="sb-nav-link-icon"><i class="fa fa-solid fa-arrow-trend-up"></i></div>
          INGRESOS
        </a>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
          <div class="sb-nav-link-icon"><i class="fa fa-solid fa-arrow-trend-down"></i></div> EGRESOS
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="../egresos/">Proyectos</a>
            <a class="nav-link" href="../egresos/pagos.php">Todos los Pagos</a>
            <a class="nav-link" href="password.html">Forgot Password</a>
          </nav>
        </div>

        <div class="sb-sidenav-menu-heading">OPCIONES</div>
        <?php if ($user->rol == 'ADMIN') : ?>
          <a class="nav-link" href="../usuarios/">
            <div class="sb-nav-link-icon"><i class="fa fa-user-plus"></i></div>
            Administrar usuarios
          </a>
        <?php endif; ?>
        <a class="nav-link" href="#" type="button">
          <div class="sb-nav-link-icon"><i class="fa fa-lock"></i></div>
          Cambiar mi contraseña
        </a>
      </div>
    </div>
    <div class="sb-sidenav-footer">
      <div class="small">Identificado como:</div>
      <?= strtoupper($user->alias) ?>
    </div>
  </nav>
</div>