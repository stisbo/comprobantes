<?php
$models = ['afiliado', 'motivo', 'usuario', 'proyecto', 'ingreso', 'egreso'];
foreach ($models as $model) {
  require_once("models/$model.php");
}
$controllers = ['cafiliado', 'cmotivo', 'cusuario', 'cproyecto'];
foreach ($controllers as $controller) {
  require_once("controllers/$controller.php");
}
