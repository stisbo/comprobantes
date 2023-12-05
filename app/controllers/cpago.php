<?php

namespace App\Controllers;

use App\Models\Pago;

class CPago {
  public function create($data, $files = null) {
    if (!isset($_COOKIE['user_obj'])) {
      echo json_encode(['status' => 'error', 'message' => 'Necesario cookies de sesion']);
    } else {
      $user = json_decode($_COOKIE['user_obj']);
      $pago = new Pago();
      $pago->concepto = $data['concepto'];
      $pago->monto = $data['monto'];
      $pago->idProyecto = $data['idProyecto'];
      $pago->idRecibidoPor = $data['idAfiliado'];
      $pago->modoPago = $data['modoPago'];
      $pago->idPagadoPor = $user->idUsuario;
      $res = $pago->save();
      if ($res) {
        $pago->idPago = $res;
        echo json_encode(['status' => 'success', 'message' => 'Pago creado', 'pago' => json_encode($pago)]);
      } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al crear afiliado']);
      }
    }
  }

  public function getXtipo($data) {
    try {
      $datos = Pago::getAll($data['tipo']);
      echo json_encode(['status' => 'success', 'data' => json_encode($datos)]);
    } catch (\Throwable $th) {
      // print_r($th);
      echo json_encode(['status' => 'error', 'message' => 'Error al obtener datos']);
    }
  }
}
