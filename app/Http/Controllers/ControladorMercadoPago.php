<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;



class ControladorMercadoPago extends Controller{

      public function aprobar($idPedido){

        $pedido = new Pedido();
        $pedido->obtenerPorId($idPedido);
        $pedido->fk_idestado = 4;
        $pedido->guardar();

        return redirect( '/pedido-gracias');

      }


      public function pendiente($idPedido){

            $pedido = new Pedido();
            $pedido->obtenerPorId($idPedido);
            $pedido->fk_idestado = 5;
            $pedido->guardar();
            return redirect( '/pedido-gracias');
    
      }

      public function error($idPedido){

            $pedido = new Pedido();
            $pedido->obtenerPorId($idPedido);
            $pedido->fk_idestado = 3;
            $pedido->guardar();
            return redirect( '/mi-cuenta');
    
      }
}