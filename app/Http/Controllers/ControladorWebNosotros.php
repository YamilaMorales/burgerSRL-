<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Postulacion;
use Illuminate\Http\Request;
class ControladorWebNosotros extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.nosotros", compact( "aSucursales" ));  
       
    }

    public function insertarPostulacion( Request $request){


        $sucursal = new Sucursal(); 
        $aSucursales = $sucursal->obtenerTodos();  
        $postulacion= new Postulacion();
        $postulacion->nombre= $request->input("txtNombre");
        $postulacion->apellido= $request->input("txtApellido");
        $postulacion->celular= $request->input("txtCelular");
        $postulacion->correo= $request->input("txtCorreo");
        $postulacion->curriculum= "";

        $postulacion->insertar();
        
        return view("web.postulacion-gracias", compact("aSucursales" ));
         

    }
}
