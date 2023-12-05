var tabla = null;
$(document).ready(async () => {
  loadInicio()
});

async function loadInicio() {
  const res = await $.ajax({
    url: '../app/cproyecto/getProjects',
    type: 'GET',
    dataType: 'json',
    data: { tipo: 'EGRESO' },
  });
  if (res.status == 'success') {
    const data = JSON.parse(res.data);
    $("#t_body_egresos").html(generarTabla(data));
  }

}

async function listar(estado) {
  if (tabla) {
    tabla.destroy();
  }
  const res = await $.ajax({
    url: '../app/cproyecto/getAll',
    type: 'GET',
    dataType: 'json',
    data: { estado, tipo: 'EGRESO' }
  });
  if (res.status == 'success') {
    let html = generarTabla(JSON.parse(res.data));
    $("#t_body_egresos").html(html);
    tabla = $("#table_egresos").DataTable({
      language: lenguaje,
      info: false,
      scrollX: true,
      columnDefs: [
        { orderable: false, targets: [3, 6] }
      ],
    })
  }
}
function generarTabla(data) {
  let html = '';
  data.forEach((element) => {
    let clsEstado = element.estado == 'PENDIENTE' ? 'text-bg-warning' : 'text-bg-primary';
    let fecha = new Date(element.fechaCreacion);
    let opciones = `
      <li><button class="dropdown-item" type="button"><i class="fa fa-eye text-primary"></i> Ver Pagos</button></li>`;
    // opciones += element.estado == 'PENDIENTE' ? `<li><button class="dropdown-item" type="button" onclick=""><i class="fa fa-sack-dollar text-success"></i> Nuevo Pago</button></li>` : '';
    opciones += `<li><button class="dropdown-item" type="button"  data-bs-toggle="modal" data-bs-target="#modal_egreso_nuevo" data-idproyecto="${element.idProyecto}"><i class="fa fa-pencil text-info"></i> Editar</button></li>`;
    html += `<tr>
    <td class="text-center">${element.idProyecto}</td>
    <td>${element.proyecto.toUpperCase()}</td>
    <td>${element.tipo}</td>
    <td class="text-end">${Number(element.montoRef).toFixed(2)}</td>
    <td>${element.alias}</td>
    <td>${fecha.toLocaleDateString()}</td>
    <td align="center"><span class="badge ${clsEstado}">${element.estado}</span></td>
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

$("#modal_egreso_nuevo").on('show.bs.modal', async (e) => {
  if (parseInt(e.relatedTarget.dataset.idproyecto) != 0) { // edit
    const res = await $.ajax({
      url: '../app/cproyecto/getProjectID',
      type: 'GET',
      data: { idProyecto: e.relatedTarget.dataset.idproyecto },
      dataType: 'json'
    });
    if (res.status == 'success') {
      const data = JSON.parse(res.data);
      console.log(data)
      $("#idProyecto_egreso").val(data.idProyecto);
      $("#descripcion_e").val(data.proyecto.toUpperCase());
      $("#monto_e").val(data.montoRef);
      let htmlOptions = `<option value="PENDIENTE" ${data.estado == 'PENDIENTE' ? 'selected' : ''}>PENDIENTE</option>
      <option value="SALDADO" ${data.estado == 'SALDADO' ? 'selected' : ''}>SALDADO</option>`;
      $("#estado_e").html(htmlOptions);
    } else {
      console.warn(res);
    }
  } else { //create
    let htmlOptions = `
    <option value="">-- Seleccione una opción --</option>
    <option value="PENDIENTE">PENDIENTE</option>
    <option value="SALDADO" >SALDADO</option>`;
    $("#estado_e").html(htmlOptions);
  }
})

$("#modal_egreso_nuevo").on('hide.bs.modal', async () => {
  setTimeout(() => {
    $("#idProyecto_egreso").val('0');
    $("#descripcion_e").val('');
    $("#monto_e").val('');
    $("#estado_e").val('');
  }, 800);
})
async function egresoUp() {
  let data = $("#form_egreso").serialize();
  data += '&tipo=EGRESO';
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