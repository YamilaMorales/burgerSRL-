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
        $aSucursales = $sucursal->obtenerTodos();
        return view("web.registrarse", compact( "aSucursales"));
    }
    public function registrarse(Request $request)

    { 
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $entidad = new Cliente;
        $entidad->nombre = $request->input("txtNombre");
        $entidad->apellido = $request->input("txtApellido");
        $entidad->direccion = $request->input("txtDireccion");
        $entidad->clave = password_hash($request->input("txtClave"), PASSWORD_DEFAULT);
        $entidad->dni = $request->input("txtDni");
        $entidad->celular = $request->input("txtCelular");
        $entidad->correo = $request->input("txtCorreo");

        if ($entidad->nombre == "" || $entidad->apellido == "" || $entidad->celular == "" || $entidad->direccion == "" || $entidad->correo == "" || $entidad->clave == "" || $entidad->dni == "") {
            $mensaje["ESTADO"] = MSG_ERROR;
            $mensaje["MSG"] = "Complete todos los datos";
            return view("web.registrarse", compact( 'mensaje', 'aSucursales'));
        } else {
            $entidad->insertar();

            $msg["ESTADO"] = MSG_SUCCESS;
            $msg["MSG"] = "Registro Exitoso.";
            return view("web.registrarse", compact('msg' ,  'aSucursales'));
        }
    }
}
