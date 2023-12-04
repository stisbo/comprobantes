<?php

namespace App\Controllers;

use App\Models\Proyecto;

class CProyecto {
  public function create($data, $files) {
    if (!isset($_COOKIE['user_obj'])) {
      echo json_encode(['status' => 'error', 'message' => 'Cookies de sesión necesarias']);
    } else {
      $user = json_decode($_COOKIE['user_obj']);
      $proyecto = new Proyecto();
      $proyecto->idUsuario = $user->idUsuario;
      $proyecto->proyecto = $data['proyecto'];
      $res = $proyecto->save();
      if ($res > 0) {
        $proyecto->idProyecto = $res;
        echo json_encode(['status' => 'success', 'message' => 'Proyecto creado con exito', 'proyecto' => json_encode($proyecto)]);
      } else {
        echo json_encode(['status' => 'error', 'message' => 'Ocurrió un error en la creación del proyecto']);
      }
    }
  }
  public function search($data) {
    try {
      $proyects = Proyecto::searchByName($data['q']);
      echo json_encode(['status' => 'success', 'data' => json_encode($proyects)]);
    } catch (\Throwable $th) {
      echo json_encode(['status' => 'error', 'error' => json_encode($th)]);
    }
  }
}
