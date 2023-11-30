$(document).ready(() => {
  listarUsuarios();
})

$(document).on('click', '#btn_modal_user', async () => {
  $(".alert-dismissible").remove()
  const data = $("#form_nuevo_user").serialize();
  const res = await $.ajax({
    url: '../app/cusuario/createSubUsuario',
    data: data,
    type: 'POST',
    dataType: 'JSON'
  });
  if (res.status == 'success') {
    $("#form_nuevo_user").append(`<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>¡Registro exitoso!</strong> El nuevo usuario puede ingresar al sistema. <u>La contraseña es la misma que el usuario.</u> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
    $("#btn_modal_user").attr('disabled', true);
  } else {
    $("#form_nuevo_user").append(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Ocurrió un error!</strong> ${res.message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`);
  }
})
$(document).on('hide.bs.modal', '#modal_usuario_nuevo', () => {
  $("#user_alias").val('');
  $("#btn_modal_user").attr('disabled', false);
  $(".alert-dismissible").remove()
})

async function listarUsuarios() {
  const res = await $.ajax({
    url: '../app/cusuario/getallUsers',
    type: 'GET',
    dataType: 'JSON'
  });

  if (res.status == 'success') {
    const data = JSON.parse(res.data);
    let htmlTable = '';
    $.each(data, (i, item) => {
      htmlTable += `<tr>
        <td>${item.idUsuario}</td>
        <td>${item.alias}</td>
        <td>${item.rol}</td>
        <td>${item.fechaCreacion}</td>
        <td></td>
      </tr>`;
    });
    $("#tbl_users").html(htmlTable);
    $("#table_usuarios").DataTable({
      language: lenguaje,
      info: false,
      scrollX: true,
    });
  }
}