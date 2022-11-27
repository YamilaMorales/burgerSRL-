<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Sucursal;

use App\Entidades\Carrito;
use Illuminate\Http\Request;
use Session;

class ControladorWebLogin extends Controller
{
    public function index(Request $request)
    {
        $idCliente = Session::get("idCliente");
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        return view("web.login", compact("aSucursales","aCarritos"));
        
    }
    public function ingresar(Request $request)
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $correo = $request->input("txtCorreo");
        $clave = $request->input("txtClave");

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $cliente = new Cliente();
        $cliente->obtenerPorCorreo($correo);
        
        if ($cliente->correo != "") {
            if (password_verify($clave, $cliente->clave)) {
                Session::put("idCliente", $cliente->idcliente);
                return view('web.index', compact("aSucursales","aCarritos"));
            } else {
                $mensaje = "Clave o Correo incorrecto.";
                return view('web.login', compact("aSucursales", "mensaje","aCarritos"));
            }
        }
    }

    public function logout()
    {
        Session::put("idCliente", "");
        return redirect("/");
    }
}
