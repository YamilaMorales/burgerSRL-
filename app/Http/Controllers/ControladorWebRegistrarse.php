<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
class ControladorWebRegistrarse extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $titulo = "Sucursales"; 
      
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.registrarse", compact("titulo" , "aSucursales" , "sucursal"));
          
    }
}