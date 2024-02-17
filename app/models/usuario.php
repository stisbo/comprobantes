<?php // propietario -> usuario principal
namespace App\Models;

use App\Config\Database;
use App\Models\Afiliado;

class Usuario {
  public int $idUsuario;
  public string $alias;
  public string $rol;
  public string $password;
  public string $fechaCreacion;
  public string $color; // color de menu
  public function __construct($idUsuario = null) {
    if ($idUsuario != null) {
      $con = Database::getInstace();
      $sql = "SELECT * FROM tblUsuario WHERE idUsuario = :idUsuario";
      $stmt = $con->prepare($sql);
      $stmt->execute(['idUsuario' => $idUsuario]);
      $row = $stmt->fetch();
      if ($row) {
        $this->idUsuario = $row['idUsuario'];
        $this->alias = $row['alias'];
        $this->rol = $row['rol'];
        $this->password = $row['password'];
        $this->color = $row['color'];
      } else {
        $this->idUsuario = 0;
        $this->alias = '';
        $this->password = '';
        $this->rol = '';
        $this->color = '#212529';
      }
    } else {
      $this->idUsuario = 0;
      $this->alias = '';
      $this->password = '';
      $this->rol = '';
      $this->color = '#212529';
    }
  }
  public function resetPass() {
    try {
      $con = Database::getInstace();
      $sql = "UPDATE tblUsuario SET password = :password WHERE idUsuario = :idUsuario";
      $stmt = $con->prepare($sql);
      $pass = hash('sha256', $this->alias);
      return $stmt->execute(['password' => $pass, 'idUsuario' => $this->idUsuario]);
    } catch (\Throwable $th) {
      return -1;
    }
  }
  public function newPass($newPass) { /// cambio de password
    try {
      $con = Database::getInstace();
      $sql = "UPDATE tblUsuario SET password = :password WHERE idUsuario = :idUsuario";
      $stmt = $con->prepare($sql);
      $pass = hash('sha256', $newPass);
      $stmt->execute(['password' => $pass, 'idUsuario' => $this->idUsuario]);
      return 1;
    } catch (\Throwable $th) {
      return -1;
    }
  }
  public function save() {
    try {
      $con = Database::getInstace();
      if ($this->idUsuario == 0) { //insert
        $sql = "INSERT INTO tblUsuario (alias, password, rol, color) VALUES (:alias, :password, :rol, :color)";
        $params = ['alias' => $this->alias, 'password' => $this->password, 'rol' => $this->rol, 'color' => '#212529'];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($params);
        if ($res) {
          $this->idUsuario = $con->lastInsertId();
          $res = $this->idUsuario;
        }
      } else { // update
        $sql = "UPDATE tblUsuario SET alias = :alias, password = :password, rol = :rol, color = :color WHERE idUsuario = :idUsuario";
        $params = ['alias' => $this->alias, 'password' => $this->password, 'rol' => $this->rol, 'color' => $this->color, 'idUsuario' => $this->idUsuario];
        $stmt = $con->prepare($sql);
        $stmt->execute($params);
        $res = 1;
      }
      return $res;
    } catch (\Throwable $th) {
      print_r($th);
      return -1;
    }
  }

  public function searchAfiliado($nombre) {
    // solo afiliados pertenecientes al grupo del usuario
    $sql = "SELECT * FROM tblAfiliado WHERE nombre like '%$nombre%'";
    $con = Database::getInstace();
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
  }
  public function load($row) {
    $this->idUsuario = $row['idUsuario'];
    $this->alias = $row['alias'];
    $this->password = $row['password'];
    $this->rol = $row['rol'];
    $this->color = $row['color'];
  }
  public function delete() {
    try {
      $con = Database::getInstace();
      $sql = "DELETE FROM tblUsuario WHERE idUsuario = :idUsuario";
      $stmt = $con->prepare($sql);
      $stmt->execute(['idUsuario' => $this->idUsuario]);
      return 1;
    } catch (\Throwable $th) {
      return -1;
    }
  }
  public static function exist($alias, $pass): Usuario {
    $con = Database::getInstace();
    $sql = "SELECT * FROM tblUsuario WHERE alias = :alias AND password = :password";
    $passHash = hash('sha256', $pass);
    $stmt = $con->prepare($sql);
    $stmt->execute(['alias' => $alias, 'password' => $passHash]);
    $row = $stmt->fetch();
    $usuario = new Usuario();
    if ($row) {
      $usuario->load($row);
      return $usuario;
    } else {
      return $usuario;
    }
  }
  public static function aliasExist($alias) {
    $con = Database::getInstace();
    $sql = "SELECT * FROM tblUsuario WHERE alias like '$alias';";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $rows = count($stmt->fetchAll());
    return $rows > 0;
  }
  public static function getAllUsers() {
    $con = Database::getInstace();
    $sql = "SELECT alias, idUsuario, rol, fechaCreacion FROM tblUsuario WHERE alias != 'stis';";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
  }
}
