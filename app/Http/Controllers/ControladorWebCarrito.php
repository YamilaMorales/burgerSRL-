<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $titulo = "Sucursales"; 
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.carrito", compact("titulo" , "aSucursales" , "sucursal"));
    }
}