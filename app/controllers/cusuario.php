<?php

namespace App\Controllers;

use App\Models\Usuario;

class CUsuario {
  public function create($data, $files) {
    $usuario = new Usuario();
    $usuario->alias = $data['alias'];
    $usuario->password = hash('sha256', $data['password']);
    // print_r($usuario);
    $res = $usuario->save();
    // echo $res . '-----';
    if ($res) {
      setcookie('user_obj', json_encode($usuario), time() + 64800, '/', false);
      echo json_encode(array('status' => 'success'));
    } else {
      echo json_encode(array('status' => 'error'));
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
      $datos = $user->searchAfiliado($data['q']);
      echo json_encode(array('status' => 'success', 'data' => $datos));
    } catch (\Throwable $th) {
      //throw $th;
      print_r($th);
    }
  }
}
