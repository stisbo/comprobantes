var tabla = null;
$(document).ready(async () => {
  listar()
})
async function listar(estado) {
  if (tabla) {
    tabla.destroy();
  }
  const res = await $.ajax({
    url: '../app/cproyecto/getProjects',
    type: 'GET',
    dataType: 'json',
    data: { tipo: 'INGRESO' },
  });
  if (res.status == 'success') {
    const data = JSON.parse(res.data);
    $("#t_body_ingresos").html(generarTabla(data));
    tabla = $("#table_ingresos").DataTable({
      language: lenguaje,
      info: false,
      scrollX: true,
      columnDefs: [
        { orderable: false, targets: [5, 6] }
      ],
    })
  }
}

function generarTabla(data) {
  let html = '';
  data.forEach((element) => {
    let fecha = new Date(element.fechaCreacion);
    let opciones = `
      <li><a class="dropdown-item" type="button" href="./pagoslist.php?proid=${element.idProyecto}"><i class="fa fa-eye text-primary"></i> Pagos Asociados</a></li>`;
    opciones += `<li><button class="dropdown-item" type="button"  data-bs-toggle="modal" data-bs-target="#modal_egreso_nuevo" data-idproyecto="${element.idProyecto}"><i class="fa fa-pencil text-info"></i> Editar</button></li>`;
    html += `<tr>
    <td class="text-center">${element.idProyecto}</td>
    <td>${element.proyecto.toUpperCase()}</td>
    <td>${element.tipo}</td>
    <td class="text-end">${Number(element.montoRef).toFixed(2)}</td>
    <td class="text-center">${element.alias.toUpperCase()}</td>
    <td>${fecha.toLocaleDateString()}</td>
    <td align="center">
      <div class="dropdown">
        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Acciones
        </button>
        <ul class="dropdown-menu">
        ${opciones}
        </ul>
      </div>
    </td>
  </tr>`
  })
  return html;
}

async function ingresoUp() {
  let data = $("#form_ingreso").serialize();
  data += '&tipo=INGRESO';
  const res = await $.ajax({
    url: '../app/cproyecto/create',
    type: 'POST',
    data,
    dataType: 'json'
  });
  if (res.status == 'success') {
    $.toast({
      heading: 'Operación exitosa',
      icon: 'success',
      position: 'top-right',
      hideAfter: 1100
    })
    setTimeout(() => {
      location.reload()
    }, 1200);
  }
  $("#modal_egreso_nuevo").modal('hide')
}