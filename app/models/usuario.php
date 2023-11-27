<?php // propietario -> usuario principal
namespace App\Models;

use App\Config\Database;
use App\Models\Afiliado;

class Usuario {
  public int $idUsuario;
  public string $alias;
  public string $password;
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
      } else {
        $this->idUsuario = 0;
        $this->alias = '';
        $this->password = '';
      }
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
  public function save() {
    try {
      $con = Database::getInstace();
      if ($this->idUsuario == 0) { //insert
        $sql = "INSERT INTO tblUsuario (alias, password) VALUES (:alias, :password)";
        $params = ['alias' => $this->alias, 'password' => $this->password];
      } else { // update
        $sql = "UPDATE tblUsuario SET alias = :alias, password = :password WHERE idUsuario = :idUsuario";
        $params = ['alias' => $this->alias, 'password' => $this->password, 'idUsuario' => $this->idUsuario];
      }
      $stmt = $con->prepare($sql);
      return $stmt->execute($params);
    } catch (\Throwable $th) {
      return -1;
    }
  }
  public function addAfiliado($nombre) {
    try {
      $afiliado = new Afiliado();
      $afiliado->nombre = $nombre;
      $afiliado->idUsuario = $this->idUsuario;
      $afiliado->save();
      return $afiliado;
    } catch (\Throwable $th) {
      //throw $th;
    }
    return null;
  }
  public function searchAfiliado($nombre) {
    $sql = "SELECT * FROM tblAfiliado WHERE nombre = :nombre AND idUsuario = :idUsuario";
  }
}
