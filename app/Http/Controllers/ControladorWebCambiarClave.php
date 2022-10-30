<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';
class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $titulo = "Sucursales"; 
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.cambiar-clave", compact("titulo" , "aSucursales" , "sucursal"));
        
    }

    public function cambiar(Request $request){
        $titulo= "Cambiar clave";
        $entidad= new Cliente ();
        $entidad->
      

    }
    
    
}