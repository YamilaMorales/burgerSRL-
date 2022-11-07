<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;


class ControladorWebPedidoGracias extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.pedido-gracias", compact(  "aSucursales"  ));
            
    }

   
}