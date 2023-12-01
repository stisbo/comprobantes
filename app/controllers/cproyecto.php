<?php

namespace App\Controllers;

use App\Models\Proyecto;
use App\Models\Egreso;
use App\Models\Ingreso;

class CProyecto {
  public function create($data, $files) {
    if(!isset($_COOKIE['user_obj'])){
      echo json_encode(['status'=>'error', 'message'=>'Cookies de sesión necesarias']);
    }else{
      $user = json_decode($_COOKIE['user_obj']);
      $idGrupo = $user->rol == 'ADMIN' ? $user->idUsuario : $user->idGrupo; 
      $proyecto = new Proyecto();
      $proyecto->tipo = $data['tipo'];
      $proyecto->monto = $data['monto'];
      $proyecto->idAfiliado = $data['idAfiliado'];
      $proyecto->estado = 'PENDIENTE';
      $proyecto->idGrupo = $idGrupo;
      $res = $proyecto->save();
      if($res > 0){
        $proyecto->idProyecto = $res;
        echo json_encode(['status'=>'success', 'message'=>'Proyecto creado con exito', 'data'=> json_encode($proyecto)]);
      }else{
        echo json_encode(['status'=>'error', 'message'=>'Ocurrió un error en la creación del proyecto']);
      }
    }
  }
}
