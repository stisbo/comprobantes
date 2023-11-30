/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector('#sidebarToggle');
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener('click', event => {
      event.preventDefault();
      document.body.classList.toggle('sb-sidenav-toggled');
      localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
  }

});

$(document).on('click', '#idLogout', async () => {
  const res = await $.ajax({
    url: '../app/cusuario/logout',
    data: {},
    type: 'POST',
    dataType: 'json',
  })
  if (res.status == 'success') {
    setTimeout(() => {
      window.location.href = '../auth/login.php';
    }, 1000);
  } else {
    console.log(res)
    // alert('Error al cerrar sesión');
  }
})

const lenguaje = {
  processing: "Procesando...",
  search: "Buscar en la tabla",
  lengthMenu: "Mostrar  _MENU_ filas ",
  paginate: {
    first: "Primero",
    previous: "Ant.",
    next: "Sig.",
    last: "Último",
  },
  emptyTable: "No hay registros...",
  infoEmpty: "No hay resultados",
  zeroRecords: "No hay registros...",
};
