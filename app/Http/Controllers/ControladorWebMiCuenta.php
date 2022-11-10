<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use App\Entidades\Sucursal;

use App\Entidades\Cliente;
use Illuminate\Http\Request;
use Session;


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
    
            $pedido = new Pedido();
            $aPedidos = $pedido->pedidoPorCliente($idCliente);
            return view("web.mi-cuenta", compact("aSucursales", "sucursal", "aPedidos", "cliente", "pedido"));
        } else {
            return redirect("/login");
        }
    }



    public function guardar(Request $request)
    {

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $cliente = new Cliente();


        $idCliente = Session::get("idCliente");
        $cliente->idcliente = $idCliente;

        $pedido = new Pedido();
        $aPedidos = $pedido->pedidoPorCliente($idCliente);
        
        $cliente->nombre = $request->input("txtNombre");
        $cliente->apellido = $request->input("txtApellido");
        $cliente->dni = $request->input("txtDni");
        $cliente->celular = $request->input("txtCelular");
        $cliente->correo = $request->input("txtCorreo");
        $cliente->direccion = $request->input("txtDireccion");
        $cliente->guardar();


       
        return view("web.mi-cuenta", compact("aSucursales", "aPedidos", "cliente", "pedido"));
    }
}
