<?php

namespace App\Controllers;

use App\Models\Usuario;

class CUsuario {
  public function create($data, $files) { // solo usuarios administradores 
    $usuario = new Usuario();
    $usuario->alias = $data['alias'];
    $usuario->password = hash('sha256', $data['password']);
    // print_r($usuario);
    $usuario->rol = 'ADMIN';
    $usuario->idGrupo = 0;
    $res = $usuario->save();
    // echo $res . '-----';
    if ($res) {
      setcookie('user_obj', json_encode($usuario), time() + 64800, '/', false);
      echo json_encode(array('status' => 'success'));
    } else {
      echo json_encode(array('status' => 'error'));
    }
  }

  public function createSubUsuario($data, $files) {
    // solo admistradores pueden crear usuarios.
    // buscamos alias en el grupo del usuario que esta logueado
    if (!isset($_COOKIE['user_obj'])) {
      echo json_encode(array('status' => 'error', 'message' => 'Cookies de sesion necesarias'));
    } else {
      $idUsuario = json_decode($_COOKIE['user_obj'])->idUsuario;
      // verifiacamos si existe el alias en el grupo
      $resExist = Usuario::aliasExist($data['alias'], $idUsuario);
      if ($resExist) {
        echo json_encode(array('status' => 'error', 'message' => 'El usuario (alias) que proporcionaste ya existe en tu grupo, intenta con otro usuario'));
      } else {
        $usuario = new Usuario();
        $usuario->alias = $data['alias'];
        $usuario->password = hash('sha256', $data['alias']);
        $usuario->rol = $data['rol'];
        $usuario->idGrupo = $idUsuario;
        $res = $usuario->save();
        if ($res > 0) {
          echo json_encode(array('status' => 'success', 'message' => 'El usuario fue creado exitosamente'));
        } else {
          echo json_encode(array('status' => 'error', 'message' => 'Ocurrió un error al crear el usuario, intenta más tarde'));
        }
      }
    }
  }
  public function login($data, $files) {
    $user = Usuario::exist($data['alias'], $data['password']);
    if ($user->idUsuario == 0) {
      echo json_encode(array('status' => 'error', 'message' => 'No existe un usuario con esas credenciales'));
    } else {
      //cookies
      // var_dump($user);
      setcookie('user_obj', json_encode($user), time() + 64800, '/', false);
      echo json_encode(array('status' => 'success', 'user' => $user));
    }
  }
  public function logout() {
    try {
      setcookie('user_obj', '', time() - 64800, '/', false);
      unset($_COOKIE['user_obj']);
      echo json_encode(array('status' => 'success'));
    } catch (\Throwable $th) {
      echo json_encode(array('status' => 'error', 'message' => $th->getMessage()));
    }
  }
  public function suggestionAfiliado($data) {
    // Recuperamos los datos de la cookie si es que esta logueado
    if (!isset($_COOKIE['user_obj'])) {
      return json_encode(array('status' => 'error', 'message' => 'Cookies de sesion necesarias'));
    }
    try {
      $userData = json_decode($_COOKIE['user_obj']);
      $user = new Usuario();
      $user->idUsuario = $userData->idUsuario;
      $user->alias = $userData->alias;
      $user->rol = $userData->rol;
      $user->idGrupo = $userData->idGrupo;
      $datos = $user->searchAfiliado($data['q']);
      echo json_encode(array('status' => 'success', 'data' => $datos));
    } catch (\Throwable $th) {
      //throw $th;
      print_r($th);
    }
  }
  public function getallUsers() {
    if (!isset($_COOKIE['user_obj'])) {
      echo json_encode(array('status' => 'error', 'message' => 'Cookies de sesion necesarias'));
    } else {
      try {
        $user = json_decode($_COOKIE['user_obj']);
        $users = Usuario::getAllUsers($user->idUsuario);
        echo json_encode(array('status' => 'success', 'data' => json_encode($users)));
      } catch (\Throwable $th) {
        print_r($th);
      }
    }
  }
  public function changepass($data, $files = null) {
    $id = $data['idUsuario'];
    $pass = $data['pass'];
    $new = $data['newPass'];
    $usuario = new Usuario($id);
    if ($usuario->idUsuario == 0) {
      echo json_encode(array('status' => 'error', 'message' => 'No existe el usuario | idUsuario incorrecto'));
    } else if ($usuario->password != hash('sha256', $pass)) {
      echo json_encode(array('status' => 'error', 'message' => 'La contraseña anterior es incorrecta'));
    } else {
      $res = $usuario->newPass($new);
      if ($res > 0) {
        echo json_encode(array('status' => 'success', 'message' => 'La contraseña fue cambiada exitosamente'));
      } else {
        echo json_encode(array('status' => 'error', 'message' => 'Ocurrió un error al cambiar la contraseña, intenta más tarde'));
      }
    }
  }

  public function changecolor($data, $files = null) {
    $id = $data['idUsuario'];
    $color = $data['color'];
    $user = new Usuario($id);
    if ($user->idUsuario != 0 && $color != '') {
      $user->color = $color;
      $res = $user->save();
      if ($res > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Cambio correcto']);
      } else {
        echo json_encode(['status' => 'error', 'message' => 'Error inesperado']);
      }
    } else {
      echo json_encode(['status' => 'error', 'message' => 'No de puede guardar, datos faltantes']);
    }
  }

  public function delete($data) {
    $id = $data['idUsuario'];
    $usuario = new Usuario($id);
    if ($usuario->idUsuario == 0) {
      echo json_encode(array('status' => 'error', 'message' => 'No existe el usuario | idUsuario incorrecto'));
    } else {
      $res = $usuario->delete();
      if ($res > 0) {
        echo json_encode(array('status' => 'success', 'message' => 'El usuario fue eliminado exitosamente'));
      } else {
        echo json_encode(array('status' => 'error', 'message' => 'Ocurrió un error al eliminar el usuario, intenta más tarde'));
      }
    }
  }
  public function update($data) {
    $idUsuario = $data['idUsuario'];
    $alias = $data['alias'];
    $rol = $data['rol'];
    $usuario = new Usuario($idUsuario);
    if ($usuario->idUsuario == 0) {
      echo json_encode(array('status' => 'error', 'message' => 'No existe el usuario | idUsuario incorrecto'));
    } else {
      $usuario->alias = $alias;
      $usuario->rol = $rol;
      $res = $usuario->save();
      if ($res > 0) {
        echo json_encode(array('status' => 'success', 'message' => 'El usuario fue actualizado exitosamente'));
      } else {
        echo json_encode(array('status' => 'error', 'message' => 'Ocurrió un error al actualizar el usuario, intenta más tarde'));
      }
    }
  }

  public function resetPass($data) {
    $id = $data['idUsuario'];
    $usuario = new Usuario($id);
    if ($usuario->idUsuario == 0) {
      echo json_encode(array('status' => 'error', 'message' => 'No existe el usuario | idUsuario incorrecto'));
    } else {
      $usuario->password = hash('sha256', $usuario->alias);
      $res = $usuario->save();
      if ($res > 0) {
        echo json_encode(array('status' => 'success', 'message' => 'La contraseña fue cambiada exitosamente'));
      } else {
        echo json_encode(array('status' => 'error', 'message' => 'Ocurrió un error al cambiar la contraseña, intenta más tarde'));
      }
    }
  }
}
