<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $titulo = "Sucursales"; 
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.cambiar-clave", compact("titulo" , "aSucursales" , "sucursal"));
        
    }
}