<?php

namespace App\Http\Controllers;
use App\Entidades\Cliente;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use Illuminate\Http\Request;
use Session; 

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $idCliente=Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.carrito", compact("aSucursales", "aCarritos", "sucursal"));
    }

    public function guardar(Request $request)
    {
        
        $carrito = new Carrito();
        $carrito->cargarDesdeRequest($request);
    }
}
