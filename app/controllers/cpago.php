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
      // guardamos los archivos enviados, si es que existen.
      $tipo = isset($data['tipo_file']) ? $data['tipo_file'] : '';
      $file = $pago->saveFile($tipo, $files, $data);
      if ($file != null || $file == '') {
        $pago->concepto = $data['concepto'];
        $pago->monto = $data['monto'];
        $pago->idProyecto = $data['idProyecto'];
        $pago->idRecibidoPor = $data['idAfiliado'];
        $pago->modoPago = $data['modoPago'];
        $pago->nameFile = $file;
        $pago->idPagadoPor = $user->idUsuario;
        $res = $pago->save();
        if ($res) {
          $pago->idPago = $res;
          echo json_encode(['status' => 'success', 'message' => 'Pago creado', 'pago' => json_encode($pago)]);
        } else {
          echo json_encode(['status' => 'error', 'message' => 'Error al crear afiliado']);
        }
      } else {
        echo json_encode(['status' => 'error', 'message' => 'No se ha podido crear el archivo del comprobante']);
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
  public function deletefile($data) {
    $domain = 'domain';
    try {
      $pago = new Pago($data['idPago']);
      $url = dirname(dirname(__DIR__));
      $url = $url . '/public/' . $domain . '/' . $pago->nameFile;
      if (unlink($url)) {
        $pago->nameFile = '';
        if ($pago->save() != -1) {
          echo json_encode(['status' => 'success', 'message' => 'Archivo eliminado']);
        } else {
          echo json_encode(['status' => 'error', 'message' => 'Se elimino el archivo pero no se actualizo en nombre de archivo']);
        }
      } else {
        echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar el archivo']);
      }
    } catch (\Throwable $th) {
      echo json_encode(['status' => 'error', 'message' => json_encode($th)]);
    }
  }
  public function update($data, $files) {
    try {
      $pago = new Pago($data['idPago']);
      $pago->concepto = $data['concepto'];
      $pago->monto = $data['monto'];
      $pago->idProyecto = $data['idProyecto'];
      $pago->idRecibidoPor = $data['idAfiliado'];
      $pago->modoPago = $data['modoPago'];
      if ($data['tipo_file'] == 'file') { // existe archivo
        $res = $pago->save();
        if ($res) {
          echo json_encode(['status' => 'success', 'message' => 'Pago actualizado', 'pago' => json_encode($pago)]);
        } else {
          echo json_encode(['status' => 'error', 'message' => 'Error al crear pago']);
        }
      } else {
        $tipo = $data['tipo_file'] == '' ? '' : $data['tipo_file'];
        $file = $pago->saveFile($tipo, $files, $data);
        if ($file != null || $file == '') {
          $pago->nameFile = $file;
          $res = $pago->save();
          if ($res) {
            echo json_encode(['status' => 'success', 'message' => 'Pago actualizado', 'pago' => json_encode($pago)]);
          } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al crear pago']);
          }
        } else {
          echo json_encode(['status' => 'error', 'message' => 'No se ha podido crear el archivo del comprobante']);
        }
      }
    } catch (\Throwable $th) {
      echo json_encode(['status' => 'error', 'message' => json_encode($th)]);
    }
  }
}
