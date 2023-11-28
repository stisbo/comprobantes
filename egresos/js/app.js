$(document).ready(() => {
  // listaTodos();
});

$(document).on('input', "#motivo_egreso", async (e) => {
  console.log(e.target.value)
  if (e.target.value.length >= 2) {
    const res = await $.ajax({
      url: `../app/CMotivo/getByName?q=${e.target.value}`,
      type: 'GET',
      dataType: 'json',
    });
    console.log(res);
  }
})

async function listaTodos() {
  const res = await $.ajax({
    url: '../app/',
    type: 'GET',
    dataType: 'json',
    data: { filtro: '' }
  });
  console.log(res);
}

async function listaPendientes() {

}

async function listaSaldados() {

}