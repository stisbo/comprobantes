<?php
$models = ['afiliado', 'motivo'];
foreach ($models as $model) {
  require_once("models/$model.php");
}
$controllers = ['cafiliado', 'cmotivo'];
foreach ($controllers as $controller) {
  require_once("controllers/$controller.php");
}
