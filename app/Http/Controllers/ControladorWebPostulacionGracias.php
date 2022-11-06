<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Client\Request;

class ControladorWebPostulacionGracias extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.postulacion-gracias", compact(  "aSucursales"  ));
            
    }

   
}