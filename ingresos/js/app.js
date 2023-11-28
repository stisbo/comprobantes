$(document).ready(function () {
  // Datos de ejemplo para las sugerencias
  var sugerencias = ["Manzana", "Banana", "Cereza", "Dátil", "Uva", "Kiwi", "Limón"];

  var $input = $("#inputWithSuggestions");
  var $suggestions = $("#suggestions");

  // Función para mostrar las sugerencias
  function mostrarSugerencias(sugerenciasFiltradas, $suggestions) {
    $suggestions.empty();
    if (sugerenciasFiltradas.length > 0) {
      $.each(sugerenciasFiltradas, function (_, sugerencia) {
        $("<li>").attr('data-exist', 1).text(sugerencia).appendTo($suggestions);
      });
    } else {
      $("<li>").attr('data-exist', 0).html($input.val() + '<button type="button" class="btn btn-success btn-sm float-end" onclick="agregarValor()"><i class="fa fa-plus"></i></button>').appendTo($suggestions);
    }
    $suggestions.show();
  }

  // Función para ocultar las sugerencias
  function ocultarSugerencias() {
    $suggestions.hide();
  }

  // Evento de entrada en el campo de entrada
  $input.on("input", function () {
    var valorInput = $input.val().toLowerCase();
    var sugerenciasFiltradas = sugerencias.filter(function (sugerencia) {
      return sugerencia.toLowerCase().includes(valorInput);
    });
    if (valorInput === "") {
      ocultarSugerencias();
    } else {
      mostrarSugerencias(sugerenciasFiltradas, $suggestions);
    }
  });

  // Evento de clic en una sugerencia
  $suggestions.on("click", "li", function () {
    var sugerenciaSeleccionada = $(this).text();
    console.log($(this).attr('data-exist'))
    $input.val(sugerenciaSeleccionada);
    ocultarSugerencias();
  });

  // Evento de clic fuera del campo de entrada y las sugerencias para ocultarlas
  $(document).on("click", function (event) {
    if (!$(event.target).closest($input).length && !$(event.target).closest($suggestions).length) {
      ocultarSugerencias();
    }
  });
});

function agregarValor() {
  console.log('Se agregara el valor registrado')
  $.toast({
    heading: 'Information',
    text: 'Loaders are enabled by default. Use `loader`, `loaderBg` to change the default behavior',
    icon: 'info',
    loader: true,        // Change it to false to disable loader
    loaderBg: '#9EC600'  // To change the background
  })
}