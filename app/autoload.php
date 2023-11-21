<?php
$controllers = [];
foreach ($controllers as $controller) {
  require_once("controllers/$controller.php");
}
