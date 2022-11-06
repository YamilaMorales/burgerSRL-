<?php

namespace App\Http\Controllers;

use App\Entidades\Producto;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use Session;
class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
       $idCliente=Session::get("idCliente");
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos(); 
        
        $carrito= new Carrito();
        $aCarritos= $carrito->obtenerPorCliente($idCliente);
        return view("web.mi-cuenta", compact(  "aSucursales" , "sucursal" , "aCarritos"));
        
    }
}