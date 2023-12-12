$(document).on('submit', '#form_update', async (e) => {
  e.preventDefault();
  const data = $(e.target).serializeArray();
  let formData = new FormData();
  console.log(data)
  $.each(data, (_, e) => {
    // console.log(e)
    formData.append(e.name, e.value)
    console.log(formData)
  });

  console.log(formData.keys())
  if (imagen != null) formData.append('imagen', imagen);
  if (audio != null) formData.append('audio', audio);
  // const res = await $.ajax({
  //   url: '../app/cpago/update',
  //   data: formData,
  //   contentType: false,
  //   processData: false,
  //   type: 'POST',
  //   dataType: 'json'
  // });
  // if (res.status == 'success') {
  //   $.toast({
  //     heading: '<b>PAGO ACTUALIZADO</b>',
  //     text: 'Se agregó el pago exitosamente',
  //     icon: 'success',
  //     position: 'top-right',
  //     stack: 3,
  //     hideAfter: 1500
  //   });
  //   setTimeout(() => {
  //     // window.location.href = './';
  //   }, 1500);
  // } else {
  //   $.toast({
  //     heading: '<b>OCURRIÓ UN ERROR</b>',
  //     text: 'No se pudo agregar el pago',
  //     icon: 'danger',
  //     position: 'top-right',
  //     stack: 2,
  //     hideAfter: 2800
  //   })
  // }
})