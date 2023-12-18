<?php // propietario -> usuario principal
namespace App\Models;

use App\Config\Database;
use App\Models\Afiliado;

class Usuario {
  public int $idUsuario;
  public string $alias;
  public string $rol;
  public int $idGrupo; // usuario propietario ADMIN = 0
  public string $password;
  public string $fechaCreacion;
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
        $this->password = $row['password'];
        $this->rol = $row['rol'];
        $this->idGrupo = $row['idGrupo'];
      } else {
        $this->idUsuario = 0;
        $this->alias = '';
        $this->password = '';
        $this->rol = '';
        $this->idGrupo = -1;
      }
    } else {
      $this->idUsuario = 0;
      $this->alias = '';
      $this->password = '';
      $this->rol = '';
      $this->idGrupo = -1;
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
        $sql = "INSERT INTO tblUsuario (alias, password, rol, idGrupo) VALUES (:alias, :password, :rol, :idGrupo)";
        $params = ['alias' => $this->alias, 'password' => $this->password, 'rol' => $this->rol, 'idGrupo' => $this->idGrupo];
        $stmt = $con->prepare($sql);
        $res = $stmt->execute($params);
        if ($res) {
          $this->idUsuario = $con->lastInsertId();
          $res = $this->idUsuario;
        }
      } else { // update
        $sql = "UPDATE tblUsuario SET alias = :alias, password = :password, rol = :rol, idGrupo = :idGrupo WHERE idUsuario = :idUsuario";
        $params = ['alias' => $this->alias, 'password' => $this->password, 'idUsuario' => $this->idUsuario, 'rol' => $this->rol, 'idGrupo' => $this->idGrupo];
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
    $idUsuario = $this->rol == 'ADMIN' ? $this->idUsuario : $this->idGrupo;
    $sql = "SELECT * FROM tblAfiliado WHERE nombre like '%$nombre%' AND idGrupo = $idUsuario";
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
    $this->idGrupo = $row['idGrupo'];
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
  public static function aliasExist($alias, $idGrupo) {
    $con = Database::getInstace();
    $sql = "SELECT * FROM tblUsuario WHERE alias like '$alias' AND (idGrupo = $idGrupo OR idGrupo = 0);";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $rows = count($stmt->fetchAll());
    return $rows > 0;
  }
  public static function getAllUsers($idGrupo) {
    $con = Database::getInstace();
    $sql = "SELECT alias, idUsuario, rol, idGrupo, fechaCreacion FROM tblUsuario WHERE (idGrupo = $idGrupo OR idUsuario = $idGrupo);";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
  }
}
