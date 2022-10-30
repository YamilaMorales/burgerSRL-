<?php
namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;


class ControladorWebHome extends Controller
{
    public function index()
    {
            return view("web.index");
    }

    public function sucursales()
    {
      $sucursal = new Sucursal();
      $titulo = "Sucursales"; 
    
      $aSucursales = $sucursal->obtenerTodos();  
      return view("web.index", compact("titulo" , "aSucursales" , "sucursal"));
    }
}
