<?php

namespace App\Models;

use App\Config\Database;
use App\Models\Afiliado;

class Proyecto {
  public int $idProyecto;
  public string $tipo;
  public float $monto;
  public string $idPropietario; // Id Usuario
  public int $idAfiliado;
  public string $estado;
  public string $fechaCreacion;
  public function __construct($idProyecto = null) {
    if ($idProyecto != null) {
      $sql = "SELECT * FROM tblProyecto WHERE idUsuario = $idProyecto";
      $con = Database::getInstace();
      $stmt = $con->prepare($sql);
      $stmt->execute([]);
      $proyectoData = $stmt->fetch(); // Utiliza fetch en lugar de fetchAll
      if ($proyectoData) {
        $this->idProyecto = $proyectoData['idProyecto'];
        $this->tipo = $proyectoData['tipo'];
        $this->monto = $proyectoData['monto'];
        $this->idPropietario = $proyectoData['idPropietario'];
        $this->idAfiliado = $proyectoData['idAfiliado'];
        $this->estado = $proyectoData['estado'];
        $this->fechaCreacion = $proyectoData['fechaCreacion'];
      } else {
        $this->objectNull();
      }
    } else {
      $this->objectNull();
    }
  }
  public function objectNull() {
    $this->idProyecto = 0;
    $this->tipo = '';
    $this->monto = 0.0;
    $this->idPropietario = '';
    $this->idAfiliado = 0;
  }
  public static function getProyectos($idPropietario) {
    $con = Database::getInstace();
    $sql = "SELECT * FROM tblProyecto WHERE idUsuario = $idPropietario";
    $stmt = $con->prepare($sql);
    $stmt->execute([]);
    $arrayProyectos = array();
    foreach ($stmt->fetchAll() as $proy) {
      $arrayProyectos[] = self::facade($proy);
    }
    return $arrayProyectos;
  }
  public static function facade($proy): Proyecto {
    $new = new Proyecto();
    $new->idProyecto = $proy['idProyecto'];
    $new->tipo = $proy['tipo'];
    $new->monto = $proy['monto'];
    $new->idPropietario = $proy['idPropietario'];
    $new->idAfiliado = $proy['idAfiliado'];
    return $new;
  }

  public function save() {
    try {
      $con = Database::getInstace();
      if ($this->idProyecto == 0) { //insert
        $sql = "INSERT INTO tblProyecto(tipo, monto, idPropietario, idAfiliado) VALUES(?, ?, ?, ?);";
        $params = [$this->tipo, $this->monto, $this->idPropietario, $this->idAfiliado];
      } else { // update
        $sql = "UPDATE tblProyecto SET tipo = ?, monto = ?, idPropietario = ?, idAfiliado = ?, estado = ?, fechaCreacion = ? WHERE idProyecto = ?";
        $params = [$this->tipo, $this->monto, $this->idPropietario, $this->idAfiliado, $this->estado, $this->fechaCreacion, $this->idProyecto];
      }
      $stmt = $con->prepare($sql);
      return $stmt->execute($params);
    } catch (\Throwable $th) {
      print_r($th);
    }
    return -1;
  }

  public function afiliado(): Afiliado {
    $afiliado = new Afiliado($this->idAfiliado);
    return $afiliado;
  }
  public function delete() {
    $con = Database::getInstace();
    $sql = "DELETE FROM tblProyecto WHERE idProyecto = ?;";
    $params = [$this->idProyecto];
    $stmt = $con->prepare($sql);
    return $stmt->execute($params);
  }
}
