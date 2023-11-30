<?php

namespace App\Models;

use App\Config\Database;

class Afiliado {
  public int $idAfiliado;
  public string $nombre;
  public int $idGrupo; // usuario al que esta asociado (grupo)

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
    $this->idGrupo = $row['idGrupo'];
  }
  public function objectNull() {
    $this->idAfiliado = 0;
    $this->nombre = '';
    $this->idGrupo = 0;
  }
  public function save() {
    try {
      $con = Database::getInstace();
      if ($this->idAfiliado == 0) { // insert
        $sql = "INSERT INTO tblAfiliado (nombre, idGrupo) VALUES (?, ?)";
        $params = [$this->nombre, $this->idGrupo];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($params);
        if ($res) {
          $this->idAfiliado = $con->lastInsertId();
          $res = $this->idAfiliado;
        }
      } else {
        $sql = "UPDATE tblAfiliado SET nombre = ?, idGrupo = ? WHERE idAfiliado = ?";
        $params = [$this->nombre, $this->idGrupo, $this->idAfiliado];
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
