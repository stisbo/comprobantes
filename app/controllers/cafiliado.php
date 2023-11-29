<?php

namespace App\Controllers;

use App\Models\Afiliado;

class CAfiliado {
  public function getByName($data) {
    $name = $data['q'];
    $afiliado = new Afiliado();
  }
}
