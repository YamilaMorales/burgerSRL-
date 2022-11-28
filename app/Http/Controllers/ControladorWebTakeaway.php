<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Producto;
use App\Entidades\Carrito;
use App\Entidades\Categoria;
use Illuminate\Http\Request;
use Session;

require app_path() . '/start/constants.php';
class ControladorWebTakeaway extends Controller
{
    public function index()
    {
        $idCliente = Session::get("idCliente");
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();
        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        return view("web.takeaway", compact("aSucursales", "aProductos", "aCategorias", "aCarritos"));
    }


    public function insertar(Request $request)
    {

        $idCliente = Session::get("idCliente");
        $idProducto = $request->input("txtProducto");
        $cantidad = $request->input("txtCantidad");

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();

        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();


        if (isset($idCliente) && $idCliente > 0) {

            if (isset($cantidad) && $cantidad > 0) {
                //se agrega al carrito y da un msj
                $carrito = new Carrito();
                $carrito->fk_idcliente = $idCliente;
                $carrito->fk_idproducto = $idProducto;
                $carrito->cantidad = $cantidad;
                $carrito->insertar();
                
                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = "¡El producto se agregó correctamente al carrito!.";
                return view('web.takeaway', compact('msg', "aCategorias", "aSucursales", "aProductos","aCarritos"));
            } else {
                //msj 
                $mensaje["ESTADO"] = MSG_ERROR;
                $mensaje["MSG"] = "El producto no se agregó al carrito. Debe indicar la cantidad deseada.";
                return view('web.takeaway', compact('mensaje', "aCategorias", "aSucursales", "aProductos","aCarritos"));
            }
        } else {
            $msg1["ESTADO"] = MSG_ERROR;
            $msg1["MSG"] = "Debe iniciar sesión para realizar un pedido.";
            return view('web.takeaway', compact('msg1', "aCategorias", "aSucursales", "aProductos","aCarritos"));
        }
    }
}
