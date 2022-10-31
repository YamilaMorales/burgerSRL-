<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\cliente;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';
class ControladorWebRegistrarse extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $titulo = "Sucursales"; 
      
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.registrarse", compact("titulo" , "aSucursales" , "sucursal"));
          
    }
    public function registrarse(Request $request){
      $titulo= "Nuevo Registro";
      $entidad = new Cliente;
      $entidad->nombre = $request->input("txtNombre");
      $entidad->clave = password_hash($request->input("txtClave"), PASSWORD_DEFAULT);
      if($entidad->nombre == "" || $entidad->apellido == "" || $entidad->telefono =="" || $entidad->direccion == "" ||$entidad->correo){
      $msg["ESTADO"] = MSG_ERROR;
      $msg["MSG"] = "Complete todos los datos";
    } else {
        $entidad->guardar();

        $msg["ESTADO"] = MSG_SUCCESS;
        $msg["MSG"] = "Registro Exitoso.";
    }
}
}