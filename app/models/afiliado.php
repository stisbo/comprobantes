<?php

namespace App\Models;

use App\Config\Database;

class Afiliado {
  public int $idAfiliado;
  public string $nombre;
  public int $idUsuario; // usuario al que esta asociado 

  public function __construct($idAfiliado = null) {
    $con = Database::getInstace();
    if ($idAfiliado != null) {
      $sql = "SELECT * FROM tblAfiliado WHERE idAfiliado = ?";
      $stmt = $con->prepare($sql);
      $stmt->execute([$idAfiliado]);
      $row = $stmt->fetch();
      if ($row == false)
        $this->objectNull();
      else
        $this->load($row);
    } else {
      $this->objectNull();
    }
  }

  public function load($row) {
    $this->idAfiliado = $row['idAfiliado'];
    $this->nombre = $row['nombre'];
    $this->idUsuario = $row['idUsuario'];
  }
  public function objectNull() {
    $this->idAfiliado = 0;
    $this->nombre = '';
    $this->idUsuario = 0;
  }
  public function save() {
    try {
      $con = Database::getInstace();
      if ($this->idAfiliado == 0) { // insert
        $sql = "INSERT INTO tblAfiliado (nombre, idUsuario) VALUES (?, ?)";
        $params = [$this->nombre, $this->idUsuario];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($params);
        if ($res) {
          $this->idAfiliado = $con->lastInsertId();
          $res = $this->idAfiliado;
        }
      } else {
        $sql = "UPDATE tblAfiliado SET nombre = ?, idUsuario = ? WHERE idAfiliado = ?";
        $params = [$this->nombre, $this->idUsuario, $this->idAfiliado];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($params);
        if (!$res) {
          $res = -1;
        }
      }
      return $res;
    } catch (\Throwable $th) {
      return -1;
    }
  }
  public function delete() {
  }
}
