$(document).ready(function () {
  // Datos de ejemplo para las sugerencias
  var sugerencias = ["Manzana", "Banana", "Cereza", "Dátil", "Uva", "Kiwi", "Limón"];

  // Cache de elementos del DOM
  var $input = $("#inputWithSuggestions");
  var $suggestions = $("#suggestions");

  // Función para mostrar las sugerencias
  function mostrarSugerencias(sugerenciasFiltradas) {
    $suggestions.empty();
    $.each(sugerenciasFiltradas, function (_, sugerencia) {
      $("<li>").text(sugerencia).appendTo($suggestions);
    });
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
      mostrarSugerencias(sugerenciasFiltradas);
    }
  });

  // Evento de clic en una sugerencia
  $suggestions.on("click", "li", function () {
    var sugerenciaSeleccionada = $(this).text();
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