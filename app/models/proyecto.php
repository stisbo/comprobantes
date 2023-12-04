<?php

namespace App\Models;

use App\Config\Database;
use App\Models\Afiliado;

class Proyecto {
  public int $idProyecto;
  public string $proyecto;
  public string $fechaCreacion;
  public int $idUsuario; // creado por
  // public float $monto;
  public function __construct($idProyecto = null) {
    if ($idProyecto != null) {
      $sql = "SELECT * FROM tblProyecto WHERE idProyecto = $idProyecto";
      $con = Database::getInstace();
      $stmt = $con->prepare($sql);
      $stmt->execute([]);
      $proyectoData = $stmt->fetch(); // Utiliza fetch en lugar de fetchAll
      if ($proyectoData) {
        $this->idProyecto = $proyectoData['idProyecto'];
        $this->proyecto = $proyectoData['proyecto'];
        $this->fechaCreacion = $proyectoData['fechaCreacion'];
        $this->idUsuario = $proyectoData['idUsuario'];
      } else {
        $this->objectNull();
      }
    } else {
      $this->objectNull();
    }
  }
  public function objectNull() {
    $this->idProyecto = 0;
    $this->proyecto = '';
    $this->fechaCreacion = '';
    $this->idUsuario = 1;
  }
  public static function searchByName($name) {
    $con = Database::getInstace();
    $sql = "SELECT * FROM tblProyecto WHERE proyecto LIKE '%$name%';";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;  
  }

  public function save() {
    $res = -1;
    try {
      $con = Database::getInstace();
      if ($this->idProyecto == 0) { //insert
        $sql = "INSERT INTO tblProyecto(proyecto, idUsuario) VALUES(?, ?);";
        $params = [$this->proyecto, $this->idUsuario];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($params);
        if ($res) {
          $this->idProyecto = $con->lastInsertId();
          $res = $this->idProyecto;
        }
      } else { // update
        $sql = "UPDATE tblProyecto SET proyecto = ?, idUsuario = ? WHERE idProyecto = ?";
        $params = [$this->proyecto, $this->idUsuario, $this->idProyecto];
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

  public function delete() {
    $con = Database::getInstace();
    $sql = "DELETE FROM tblProyecto WHERE idProyecto = ?;";
    $params = [$this->idProyecto];
    $stmt = $con->prepare($sql);
    return $stmt->execute($params);
  }
}
