<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use App\Entidades\CarritoProducto;
use App\Entidades\Pedido;
use Illuminate\Http\Request;
use Session;

require app_path() . '/start/constants.php';
class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.carrito", compact("aSucursales", "aCarritos", "sucursal"));
    }



    public function procesar(Request $request)
    {


        if (isset($_POST["btnEliminar"])) {
            return $this->eliminar($request);
        } else if (isset($_POST["btnActualizar"])) {
            return $this->actualizar($request);
        } else if (isset($_POST["btnFinalizar"])) {
            return $this->insertarPedido($request);
        }
    }


    public function actualizar(Request $request)
    {
        $idCliente = Session::get("idCliente");

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $cantidad = $request->input("txtCantidad");
        $idCarrito = $request->input("txtCarrito");
        $idProducto = $request->input("txtProducto");




        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $carrito->cantidad = $cantidad;
        $carrito->fk_idcliente = $idCliente;
        $carrito->fk_idproducto = $idCliente;
        $carrito->guardar();
        $msg["ESTADO"] = EXIT_SUCCESS;
        $msg["MSG"] = "Producto actualizado con exito.";
        return view('web.carrito', compact('msg',  'aSucursales', 'aCarritos'));
    }


    public function eliminar(Request $request)

    {

        $idCliente = Session::get("idCliente");

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $idCarrito = $request->input("txtCarrito");
        $carrito = new Carrito();
        $carrito->idcarrito = $idCarrito;
        $carrito->eliminar();
        $msg["ESTADO"] = EXIT_SUCCESS;
        $msg["MSG"] = "Producto eliminado con exito.";
        return view('web.carrito', compact('msg',  'aSucursales', 'aCarritos'));
    }

    public function insertarPedido(Request $request)
    {
        $idCliente = Session::get("idCliente");
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $total = 0;
        foreach ($aCarritos as $item) {
            $total += $item->cantidad * $item->precio;
        }

        $sucursal = $request->input("lstSucursal");
        $pago = $request->input("lstPago");
        $fecha = date("Y-m-d");

        $pedido = new Pedido();
        $pedido->fk_idsucursal = $sucursal;
        $pedido->fk_idcliente = $idCliente;
        $pedido->fk_idestado = 1;
        $pedido->descripcion = "";
        $pedido->fecha = $fecha;
        $pedido->total = $total;
        $pedido->pago = $pago;
        $pedido->insertar();


        $carrito_producto = new CarritoProducto();
        foreach ($aCarritos as $item) {
            $carrito_producto->fk_idproducto = $item->fk_idproducto;
            $carrito_producto->fk_idpedido = $pedido->idpedido;
            $carrito_producto->insertar();
        }
        $carrito->eliminarPorCliente($idCliente);

        return view("web.pedido-gracias", compact("aSucursales", "aCarritos"));
    }
}
