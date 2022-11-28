<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\cliente;
use App\Entidades\Carrito;
use Illuminate\Http\Request;
use Session;

require app_path() . '/start/constants.php';
class ControladorWebRegistrarse extends Controller
{
    public function index()
    {
        
        $idCliente = Session::get("idCliente");
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.registrarse", compact("aSucursales","aCarritos"));
    }
    public function registrarse(Request $request)

    {
        $idCliente = Session::get("idCliente");
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $entidad = new Cliente;
        $entidad->nombre = $request->input("txtNombre");
        $entidad->apellido = $request->input("txtApellido");
        $entidad->direccion = $request->input("txtDireccion");
        $entidad->clave = password_hash($request->input("txtClave"), PASSWORD_DEFAULT);
        $entidad->dni = $request->input("txtDni");
        $entidad->celular = $request->input("txtCelular");
        $entidad->correo = $request->input("txtCorreo");


        if ($entidad->nombre == "" || $entidad->apellido == "" || $entidad->dni == "" || $entidad->correo == "" || $entidad->celular == "" || $entidad->direccion == "") {
            $mensaje["ESTADO"] = MSG_ERROR;
            $mensaje["MSG"] = "Complete todos los datos";
            return view("web.registrarse", compact('mensaje', 'aSucursales',"aCarritos"));
        } else {
            $entidad->insertar();

            return redirect("/login");
        }
    }
}
