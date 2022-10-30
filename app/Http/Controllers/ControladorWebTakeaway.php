<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
class ControladorWebTakeaway extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $titulo = "Sucursales"; 
      
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.takeaway", compact("titulo" , "aSucursales" , "sucursal"));
           
    }
}
