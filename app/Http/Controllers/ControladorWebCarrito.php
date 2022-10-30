<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use Illuminate\Http\Request;

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $idCliente = 5;
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $sucursal = new Sucursal();
        $titulo = "Sucursales";
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.carrito", compact("aSucursales", "aCarritos"));
    }

    public function guardar(Request $request)
    {
        $titulo = "Nuevo carrito";
        $carrito = new Carrito();
        $carrito->cargarDesdeRequest($request);
    }
}
