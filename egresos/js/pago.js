$(document).ready(function () {
  console.log('cargado')
})



// ocultamos la sugerencia por el ID
function ocultarSugerencias(idSugg) {
  $("#" + idSugg).hide();
}
function mostrarSugerenciasProyecto(arraySuggestions, idSugg, input_id) {
  $suggestions = $("#" + idSugg);
  $suggestions.empty();
  if (arraySuggestions.length > 0) {
    $.each(arraySuggestions, function (_, sugerencia) {
      $("<li>").attr('data-exist', 1).attr('data-idinput', input_id).attr('data-idproyecto', sugerencia.idProyecto).text(sugerencia.proyecto).appendTo($suggestions);
    });
  } else {
    if ($(`#${input_id}`).val().length > 2) {
      $("<li>").attr('data-exist', 0).attr('data-idinput', input_id).html($("#" + input_id).val() + '<button type="button" class="btn btn-success btn-sm float-end" onclick="agregarProyecto()"><i class="fa fa-plus"></i></button>').appendTo($suggestions);
    }
  }
  $suggestions.show();
}

function mostrarSugerenciasAfiliado(arraySuggestions, idSugg, input_id) {
  $suggestions = $("#" + idSugg);
  $suggestions.empty();
  if (arraySuggestions.length > 0) {
    $.each(arraySuggestions, function (_, sugerencia) {
      $("<li>").attr('data-exist', 1).attr('data-idinput', input_id).attr('data-idproyecto', sugerencia.idAfiliado).text(sugerencia.nombre.toUpperCase()).appendTo($suggestions);
    });
  } else {
    if ($(`#${input_id}`).val().length > 2) {
      $("<li>").attr('data-exist', 0).attr('data-idinput', input_id).html($("#" + input_id).val() + '<button type="button" class="btn btn-success btn-sm float-end" onclick="agregarAfiliado()"><i class="fa fa-plus"></i></button>').appendTo($suggestions);
    }
  }
  $suggestions.show();
}

$(document).on('input', '#tipo_detalle', async (e) => {
  $input = $("#tipo_detalle");
  var valorInput = $input.val().toLowerCase();
  if (valorInput.length < 3) {
    ocultarSugerencias('suggestion_proy');
    return;
  }
  var res = await $.ajax({
    url: '../app/cproyecto/search',
    type: 'GET',
    dataType: 'json',
    data: { q: valorInput }
  })
  console.log(res)
  console.log(JSON.parse(res.data))
  if (res.status == 'success') {
    mostrarSugerenciasProyecto(JSON.parse(res.data), 'suggestion_proy', 'tipo_detalle');
  }
})
$(document).on('input', '#afiliado_to', async (e) => {
  $input = $("#afiliado_to");
  var valorInput = $input.val().toLowerCase();
  if (valorInput.length < 2) {
    ocultarSugerencias('suggestions_afiliado');
    return;
  }
  var res = await $.ajax({
    url: '../app/cafiliado/suggestionAfiliado',
    type: 'GET',
    dataType: 'json',
    data: { q: valorInput }
  })
  console.log(res)
  console.log(JSON.parse(res.data))
  if (res.status == 'success') {
    mostrarSugerenciasAfiliado(JSON.parse(res.data), 'suggestions_afiliado', 'afiliado_to');
  }
});
$(document).on('click', '#suggestion_proy li', (e) => {
  $val = $(e.target);
  if (e.target.tagName == 'LI') {
    if ($val.data('exist') == 1) {
      $("#" + $val.data('idinput')).val($val.text().toUpperCase());
      $("#idProyecto").val($val.data('idproyecto'));
      ocultarSugerencias('suggestion_proy');
    } else {
      $.toast({
        heading: '<b>No existe el proyecto</b>',
        text: 'Agrégalo haciendo click en el boton verde',
        icon: 'warning',
        position: 'top-right',
        stack: 2,
        hideAfter: 2500
      })
    }
  }
})

$(document).on('click', '#suggestions_afiliado li', (e) => {
  $val = $(e.target);
  if (e.target.tagName == 'LI') {
    if ($val.data('exist') == 1) {
      $("#" + $val.data('idinput')).val($val.text().toUpperCase());
      $("#idProyecto").val($val.data('idproyecto'));
      ocultarSugerencias('suggestion_proy');
    } else {
      $.toast({
        heading: '<b>No existe el afiliado</b>',
        text: 'Agrégalo haciendo click en el boton verde',
        icon: 'warning',
        position: 'top-right',
        stack: 2,
        hideAfter: 2500
      })
    }
  }
})

$(document).on("click", function (event) {
  // verificamos si se hizo click en otra parte
  $input = $("#afiliado");
  // input id
  $suggestions = $("#suggestions_afiliado");
  if (!$(event.target).closest($input).length && !$(event.target).closest($suggestions).length) {
    ocultarSugerencias('suggestions_afiliado');
  }
  $input = $("#tipo_detalle");
  // input id
  $suggestions = $("#suggestion_proy");
  if (!$(event.target).closest($input).length && !$(event.target).closest($suggestions).length) {
    ocultarSugerencias('suggestion_proy');
  }
});

async function agregarProyecto() {
  const proyecto = $("#tipo_detalle").val()
  const res = await $.ajax({
    url: '../app/cproyecto/create',
    type: 'POST',
    dataType: 'json',
    data: { proyecto }
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
    $("#tipo_detalle").val(proyecto.toUpperCase());
    const data = JSON.parse(res.proyecto);
    $("#idProyecto").val(data.idProyecto)
    ocultarSugerencias('suggestion_proy');
  } else {
    $.toast({
      heading: 'Ocurrió un error',
      text: 'No se pudo agregar el proyecto',
      icon: 'danger',
      position: 'top-right',
      stack: 2,
      hideAfter: 2000
    })
  }
}
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