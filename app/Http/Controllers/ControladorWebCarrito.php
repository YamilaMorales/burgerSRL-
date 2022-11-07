<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use Illuminate\Http\Request;
use Session; 

require app_path() . '/start/constants.php';
class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $idCliente=Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.carrito", compact("aSucursales", "aCarritos", "sucursal"));
    }



    public function procesar (Request $request){

        
        if(isset($_POST["btnEliminar"])){
            $this->eliminar($request);
        } else if(isset($_POST["btnActualizar"])){
            $this->actualizar($request);

        } else if(isset($_POST["btnFinalizar"])){
            $this->insertarPedido($request);
        }

    }


    public function actualizar(Request $request)
    {
        $idCliente=Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $cantidad = $request->input("txtCantidad");
       
        $carrito = new Carrito();
        $carrito->cantidad = $cantidad;
        $carrito->guardar();
        $msg["ESTADO"] = EXIT_SUCCESS;
        $msg["MSG"] = "Producto actualizado con exito.";
        return view('web.carrito', compact('msg', 'aCarritos', 'aSucursales'));

    }


    public function eliminar(Request $request)
    
    {

        $idCliente=Session::get("idCliente");
       
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCarrito = $request->input("txtCarrito");
        $carrito = new Carrito();
        $carrito->idcarrito = $idCarrito;
        $carrito->eliminar();
        $msg["ESTADO"] = EXIT_SUCCESS;
        $msg["MSG"] = "Producto eliminado con exito.";
        return view('web.carrito', compact('msg',  'aSucursales'));
    }

    public function insertarPedido(Request $request)
    {
        
    }
}
