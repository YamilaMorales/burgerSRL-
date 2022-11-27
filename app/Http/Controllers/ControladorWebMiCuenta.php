<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use App\Entidades\Sucursal;
use App\Entidades\Carrito;

use App\Entidades\Cliente;
use Illuminate\Http\Request;
use Session;
require app_path() . '/start/constants.php';

class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        


        $idCliente = Session::get("idCliente");
       

        if ($idCliente != "") {
            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);

            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
    
            $carrito = new Carrito();
            $aCarritos = $carrito->obtenerPorCliente($idCliente);

            $entidadPedido = new Pedido();
            $aPedidos= $entidadPedido->pedidoPorCliente($idCliente);
            return view("web.mi-cuenta", compact("aSucursales", "sucursal", "aPedidos", "cliente", "aCarritos"));
        } else {
            return redirect("/login");
        }
    }



    public function guardar(Request $request)
    {

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $cliente = new Cliente();
        $cliente->idcliente = $idCliente;
        $entidadPedido = new Pedido();
        $aPedidos = $entidadPedido->pedidoPorCliente($idCliente);
       
        $cliente->nombre = $request->input("txtNombre");
        $cliente->apellido = $request->input("txtApellido");
        $cliente->dni = $request->input("txtDni");
        $cliente->celular = $request->input("txtCelular");
        $cliente->correo = $request->input("txtCorreo");
        $cliente->direccion = $request->input("txtDireccion");
        $cliente->clave = $request->input("txtClave");
        $cliente->guardar();

          
       
        $mensaje["ESTADO"] = MSG_SUCCESS;
        $mensaje["MSG"] = "Datos actualizados correctamente.";
        
        return view("web.mi-cuenta", compact("aSucursales", "aPedidos", "cliente",'mensaje',"aCarritos"));
    }
}
