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
        <a class="nav-link" id="nav-id-egresos" href="../egresos/">
          <div class="sb-nav-link-icon"><i class="fa fa-solid fa-arrow-trend-down"></i></div>
          EGRESOS
        </a>
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
          <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
          SALIDAS
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
              Authentication
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="login.html">Login</a>
                <a class="nav-link" href="register.html">Register</a>
                <a class="nav-link" href="password.html">Forgot Password</a>
              </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
              Error
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="401.html">401 Page</a>
                <a class="nav-link" href="404.html">404 Page</a>
                <a class="nav-link" href="500.html">500 Page</a>
              </nav>
            </div>
          </nav>
        </div>
        <div class="sb-sidenav-menu-heading">OPCIONES</div>
        <a class="nav-link" href="charts.html">
          <div class="sb-nav-link-icon"><i class="fa fa-user-plus"></i></div>
          Agregar usuario
        </a>
        <a class="nav-link" href="tables.html">
          <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
          Tables
        </a>
      </div>
    </div>
    <div class="sb-sidenav-footer">
      <div class="small">Identificado como:</div>
      <?= strtoupper($user->alias) ?>
    </div>
  </nav>
</div>