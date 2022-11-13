<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class ControladorMercadoPago extends Controller{

      public function aprobar($idPedido){

        $pedido = new Pedido();
        $pedido->obtenerPorId($idPedido);
        $pedido->fk_idestado = 4;
        $pedido->guardar();

        return redirect( '/mi-cuenta');

      }


      public function pendiente($idPedido){

            $pedido = new Pedido();
            $pedido->obtenerPorId($idPedido);
            $pedido->fk_idestado = 5;
            $pedido->guardar();
            return redirect( '/mi-cuenta');
    
      }

      public function error($idPedido){

            $pedido = new Pedido();
            $pedido->obtenerPorId($idPedido);
            $pedido->fk_idestado = 3;
            $pedido->guardar();
            return redirect( '/mi-cuenta');
    
      }
}