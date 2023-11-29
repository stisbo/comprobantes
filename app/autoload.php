<?php
$models = ['afiliado', 'motivo', 'usuario'];
foreach ($models as $model) {
  require_once("models/$model.php");
}
$controllers = ['cafiliado', 'cmotivo', 'cusuario'];
foreach ($controllers as $controller) {
  require_once("controllers/$controller.php");
}
