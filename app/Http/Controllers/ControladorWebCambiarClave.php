<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\Carrito;
use Illuminate\Http\Request;

use Session;

use function PHPUnit\Framework\returnSelf;

require app_path() . '/start/constants.php';
class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente); 

        return view("web.cambiar-clave", compact("aSucursales", "sucursal","aCarritos"));
    }

    public function cambiar(Request $request)
    {

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        
        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente); 
       
        $cliente = new Cliente();
        $clave1 = $request->input("txtClave1");
        $clave2 = $request->input("txtClave2");

        if ($clave1 != "" && $clave1 == $clave2) {
            $cliente->obtenerPorId($idCliente);
            $cliente->clave = password_hash($clave1, PASSWORD_DEFAULT);
            $cliente->guardar();
            $mensaje["ESTADO"] = MSG_SUCCESS;
            $mensaje["MSG"] = "Contraseña actualizada con exito.";

            return view("web.cambiar-clave", compact("aSucursales", "mensaje","aCarritos"));
        } else {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Las contraseñas no coinciden.";

            return view("web.cambiar-clave", compact("aSucursales", "msg","aCarritos"));
        }
    }
}
