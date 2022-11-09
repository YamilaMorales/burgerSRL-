<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use App\Entidades\Cliente;
use Session;
class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
       $idCliente=Session::get("idCliente");
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos(); 
        $cliente= new Cliente();
        $aClientes=$cliente->obtenerTodos();
        $pedido= new Pedido();
        $aPedidos= $pedido->pedidoPorCliente($idCliente);
        return view("web.mi-cuenta", compact(  "aSucursales" , "sucursal" , "aPedidos","cliente"));
        
    }
}