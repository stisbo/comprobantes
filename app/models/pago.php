<?php

namespace App\Models;

use App\Config\Database;

class Pago {
  public int $idPago;
  public int $idProyecto;
  public string $concepto;
  public float $monto;
  public string $modoPago;
  public int $idPagadoPor; // usuario
  public int $idRecibidoPor; // afiliado
  public string $fechaRegistro;

  public function __construct($idPago = null) {
    $con = Database::getInstace();
    if ($idPago != null) {
      $sql = "SELECT * FROM tblPago WHERE idProyecto = $idPago";
      $stmt = $con->prepare($sql);
      $stmt->execute([]);
      $pagoRow = $stmt->fetch(); // Utiliza fetch en lugar de fetchAll
      if ($pagoRow) {
        $this->idPago = $pagoRow['idPago'];
        $this->idProyecto = $pagoRow['idProyecto'];
        $this->concepto = $pagoRow['concepto'];
        $this->monto = $pagoRow['monto'];
        $this->modoPago = $pagoRow['modoPago'];
        $this->idPagadoPor = $pagoRow['idPagadoPor'];
        $this->idRecibidoPor = $pagoRow['idRecibidoPor'];
        $this->fechaRegistro = $pagoRow['fechaRegistro'];
      } else {
        $this->objectNull();
      }
    } else {
      $this->objectNull();
    }
  }
  public function objectNull() {
    $this->idPago = 0;
    $this->monto = 0.0;
    $this->idProyecto = 0;
    $this->concepto = '';
    $this->modoPago = '';
    $this->idPagadoPor = 0;
    $this->idRecibidoPor = 0;
    $this->fechaRegistro = '';
  }
  public function save() {
    $res = -1;
    try {
      $con = Database::getInstace();
      if ($this->idPago == 0) { //insert
        $sql = "INSERT INTO tblPago(concepto, monto, idProyecto, modoPago, idPagadoPor, idRecibidoPor) VALUES(?, ?, ?, ?, ?, ?);";
        $params = [$this->concepto, $this->monto, $this->idProyecto, $this->modoPago, $this->idPagadoPor, $this->idRecibidoPor];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($params);
        if ($res) {
          $this->idPago = $con->lastInsertId();
          $res = $this->idPago;
        }
      } else { // update
        $sql = "UPDATE tblPago SET idProyecto = ?, concepto = ?, modoPago = ?, idPagadoPor = ?, idRecibidoPor = ?, monto = ? WHERE idPago = ?";
        $params = [$this->idProyecto, $this->concepto, $this->modoPago, $this->idPagadoPor, $this->idRecibidoPor, $this->monto, $this->idPago];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($params);
        if (!$res) {
          $res = -1;
        }
      }
    } catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }

  public static function getAll($tipo) {
    try { // obtener los valores por fecha del ultimo mes
      $con = Database::getInstace();
      $hoy = date('Y-m-d', strtotime('+1 days'));
      $mesAnterior = date('Y-m-d', strtotime('-1 month'));
      $sql = "SELECT t.*, UPPER(concat(p.proyecto,' | ',t.concepto)) as detalle FROM tblPago t
      INNER JOIN tblProyecto p ON t.idProyecto = p.idProyecto
      WHERE p.tipo LIKE '$tipo' AND
      t.fechaRegistro between '$mesAnterior' AND '$hoy'";
      $stmt = $con->prepare($sql);
      $stmt->execute([]);
      $res = $stmt->fetchAll();
      return $res;
    } catch (\Throwable $th) {
      print_r($th);
      return [];
    }
  }
}
