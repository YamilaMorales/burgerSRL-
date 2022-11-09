<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Illuminate\Http\Request;
use Session;

use function PHPUnit\Framework\returnSelf;

require app_path() . '/start/constants.php';
class ControladorWebCambiarClave extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $titulo = "Sucursales";
        $aSucursales = $sucursal->obtenerTodos();
        return view("web.cambiar-clave", compact("titulo", "aSucursales", "sucursal"));
    }

    public function cambiar(Request $request)
    {

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $idCliente = Session::get("idCliente");
        $cliente = new Cliente();
        $clave1 = $request->input("txtClave1");
        $clave2 = $request->input("txtClave2");

        if ($clave1 != "" && $clave1 == $clave2) {
            $cliente->obtenerPorId($idCliente);
            $cliente->clave = password_hash($clave1, PASSWORD_DEFAULT);
            $cliente->guardar();
            $mensaje["ESTADO"] = MSG_SUCCESS;
            $mensaje["MSG"] = "Contraseña actualizada con exito.";

            return view("web.cambiar-clave", compact("aSucursales", "mensaje"));
        } else {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Las contraseñas no coinciden.";

            return view("web.cambiar-clave", compact("aSucursales", "msg"));
        }
    }
}
