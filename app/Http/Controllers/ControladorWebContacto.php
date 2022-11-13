<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
class ControladorWebContacto extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $titulo = "Sucursales"; 
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.contacto", compact("titulo" , "aSucursales" , "sucursal"));
        
           
    }

    
}
