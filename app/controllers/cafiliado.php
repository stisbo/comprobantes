<?php

namespace App\Controllers;

use App\Models\Afiliado;

class CAfiliado {
  public function create($data, $files = null) {
    if (!isset($_COOKIE['user_obj'])) {
      echo json_encode(['status' => 'error', 'message' => 'Cookies de session necesarias']);
    } else {
      try {
        $afiliado = new Afiliado();
        $user = json_decode($_COOKIE['user_obj']);
        $afiliado->nombre = $data['nombre'];
        if ($user->rol == 'ADMIN') {
          $afiliado->idGrupo = $user->idUsuario;
        } else {
          $afiliado->idGrupo = $user->idGrupo;
        }
        $res = $afiliado->save();
        if ($res) {
          $afiliado->idAfiliado = $res;
          echo json_encode(['status' => 'success', 'message' => 'Afiliado creado', 'afiliado' => json_encode($afiliado)]);
        }
      } catch (\Throwable $th) {
        // print_r($th);
        echo json_encode(['status' => 'error', 'message' => 'Error al crear afiliado']);
      }
    }
  }
}
