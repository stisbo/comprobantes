$(document).ready(async () => {
  loadInicio()
});

async function loadInicio() {
  await $("#main_egresos").load('./cabeceraLista.php');
  await listar('all');
  $("#table_egresos").DataTable({
    language: lenguaje,
    info: false,
    scrollX: true,
    columnDefs: [
      { orderable: false, targets: [3, 6] }
    ],
  })
}

$(document).on('input', "#motivo_egreso", async (e) => {
  // console.log(e.target.value)
  if (e.target.value.length >= 2 && e.target.value.length <= 8) {
    const res = await $.ajax({
      url: `../app/cmotivo/getByName?q=${e.target.value}`,
      type: 'GET',
      dataType: 'json',
    });
    // console.log(res);
    let html = '';
    res.forEach(element => {
      html += `<option value="${element.motivo.toUpperCase()}">`
    });
    $("#lista_motivo").html(html);
  }
});

async function listar(estado) {
  const res = await $.ajax({
    url: '../app/cproyecto/getAll',
    type: 'GET',
    dataType: 'json',
    data: { estado, tipo: 'EGRESO' }
  });
  if (res.status == 'success') {
    let html = generarTabla(JSON.parse(res.data));
    $("#t_body_egresos").html(html);
  }
}
function generarTabla(data) {
  let html = '';
  data.forEach((element) => {
    let clsEstado = element.estado == 'PENDIENTE' ? 'text-bg-warning' : 'text-bg-primary';
    let fecha = new Date(element.fechaCreacion);
    let opciones = `
      <li><button class="dropdown-item" type="button"><i class="fa fa-eye text-primary"></i> Ver Pagos</button></li>`;
    opciones += element.estado == 'PENDIENTE' ? `<li><button class="dropdown-item" type="button" onclick=""><i class="fa fa-sack-dollar text-success"></i> Nuevo Pago</button></li>` : '';
    html += `<tr>
    <td class="text-center">${element.idProyecto}</td>
    <td>${element.motivo}</td>
    <td>${element.nombre.toUpperCase()}</td>
    <td>${fecha.toLocaleDateString()} ${fecha.toLocaleTimeString()}</td>
    <td class="text-center">${element.alias.toUpperCase()}</td>
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
async function listaPendientes() {

}

async function listaSaldados() {

}

function mostrarSugerencias(arraySuggestions, idSugg, input_id) {
  $suggestions = $("#" + idSugg);
  $suggestions.empty();
  if (arraySuggestions.length > 0) {
    $.each(arraySuggestions, function (_, sugerencia) {
      $("<li>").attr('data-exist', 1).attr('data-idinput', input_id).attr('data-idafiliado', sugerencia.idAfiliado).text(sugerencia.nombre).appendTo($suggestions);
    });
  } else {
    if ($(`#${input_id}`).val().length > 2) {
      $("<li>").attr('data-exist', 0).attr('data-idinput', input_id).html($("#" + input_id).val() + '<button type="button" class="btn btn-success btn-sm float-end" onclick="agregarValor()"><i class="fa fa-plus"></i></button>').appendTo($suggestions);
    }
  }
  $suggestions.show();
}
function ocultarSugerencias(idSugg) {
  $("#" + idSugg).hide();
}
$(document).on('click', '.suggestions li', (e) => {
  $val = $(e.target);
  if (e.target.tagName == 'LI') {
    if ($val.data('exist') == 1) {
      $("#" + $val.data('idinput')).val($val.text());
      $("#idAfiliado_modal").val($val.data('idafiliado'));
      ocultarSugerencias('suggestions');
    } else {
      $.toast({
        heading: 'El usuario no existe',
        text: 'Agrégalo haciendo click en el boton +',
        icon: 'warning',
        position: 'top-right',
        stack: 2,
        hideAfter: 2000
      })
    }
  }
})
$(document).on("click", function (event) {
  // verificamos si se hizo click en otra parte
  $input = $("#afiliado");
  // input id
  $suggestions = $("#suggestions");
  if (!$(event.target).closest($input).length && !$(event.target).closest($suggestions).length) {
    ocultarSugerencias('suggestions');
  }
});
$(document).on('input', '#afiliado', async (e) => {
  $input = $("#afiliado");
  var valorInput = $input.val().toLowerCase();
  if (valorInput.length < 2) {
    ocultarSugerencias('suggestions');
    return;
  }
  var res = await $.ajax({
    url: '../app/cusuario/suggestionAfiliado',
    type: 'GET',
    dataType: 'json',
    data: { q: valorInput }
  })
  if (res.status == 'success') {
    mostrarSugerencias(res.data, 'suggestions', 'afiliado');
  }
})

async function agregarValor() {
  const nombre = $("#afiliado").val()
  const res = await $.ajax({
    url: '../app/cafiliado/create',
    type: 'GET',
    dataType: 'json',
    data: { nombre }
  })
  if (res.status == 'success') {
    $.toast({
      heading: 'Operación exitosa',
      text: 'Agregado correctamente',
      icon: 'success',
      position: 'top-right',
      stack: 2,
      hideAfter: 1550
    })
    $("#afiliado").val(nombre);
    const afiliado = JSON.parse(res.afiliado);
    $("#idAfiliado_modal").val(afiliado.idAfiliado)
    ocultarSugerencias('suggestions');
  } else {
    $.toast({
      heading: 'Ocurrió un error',
      text: 'No se pudo agregar al usuario',
      icon: 'danger',
      position: 'top-right',
      stack: 2,
      hideAfter: 2000
    })
  }
}

async function createEgreso() {
  let data = $("#form_egreso").serialize();
  data += '&tipo=EGRESO';
  console.log(data)
  const res = await $.ajax({
    url: '../app/cproyecto/create',
    type: 'POST',
    data,
    dataType: 'json'
  });
  console.log(res)
  if (res.status == 'success') {
    $("#modal_egreso_nuevo").modal('hide');
    $.toast({
      heading: 'Registro exitoso',
      text: 'Proyecto de tipo EGRESO registrado correctamente',
      icon: 'success',
      position: 'top-right',
      hideAfter: 1900
    });
    const proyecto = JSON.parse(res.data);
    $("#idProyecto_pago").val(proyecto.idProyecto);
    $("#motivo_proyecto").val(proyecto.motivo);
    $("#monto_pago").val(proyecto.monto);
    $("#modal_pago_nuevo").modal('show');
  } else {
    $.toast({
      heading: 'Ocurrió un error',
      text: 'No se pudo registrar el proyecto',
      icon: 'error',
      position: 'top-right',
      hideAfter: 1900
    })
  }
}
$(document).on('hide.bs.modal', '#modal_pago_nuevo', () => {
  setTimeout(() => {
    $("#idProyecto_pago").val('');
    $("#motivo_proyecto").val('');
    $("#monto_pago").val('');
  }, 900);
})

$(document).on('hide.bs.modal', '#modal_egreso_nuevo', () => {
  setTimeout(() => {
    $("#motivo_egreso").val('');
    $("#monto_egreso").val('');
    $("#afiliado").val('')
    $("#idAfiliado_modal").val('')
  }, 900);
})