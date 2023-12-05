<?php
$models = ['afiliado', 'motivo', 'usuario', 'proyecto', 'pago'];
foreach ($models as $model) {
  require_once("models/$model.php");
}
$controllers = ['cafiliado', 'cmotivo', 'cusuario', 'cproyecto', 'cpago'];
foreach ($controllers as $controller) {
  require_once("controllers/$controller.php");
}
