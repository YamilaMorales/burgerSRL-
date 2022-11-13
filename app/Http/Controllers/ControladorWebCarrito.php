<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use App\Entidades\Cliente;
use App\Entidades\Pedido_Producto;
use App\Entidades\Pedido;
use Illuminate\Http\Request;
use Session;

use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

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
     
        $idSucursal = $request->input("lstSucursal");
        $pago = $request->input("lstPago");
        $descripcion = $request->input("txtDescripcion");

        if ($pago == "MercadoPago") {


            $this->procesarMercadoPago($request);
        } else {

            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
            $carrito = new Carrito();
            $aCarritos = $carrito->obtenerPorCliente($idCliente);

            $total = 0;
            foreach ($aCarritos as $item) {
                $total += $item->cantidad * $item->precio;
            }

            $fecha = date("Y-m-d");

            $pedido = new Pedido();
            $pedido->fk_idsucursal = $idSucursal;
            $pedido->fk_idcliente = $idCliente;
            $pedido->fk_idestado = 1;
            $pedido->descripcion = $descripcion;
            $pedido->fecha = $fecha;
            $pedido->total = $total;
            $pedido->pago = $pago;
            $pedido->insertar();


            $pedidoProducto = new Pedido_Producto();
            foreach ($aCarritos as $item) {
                $pedidoProducto->fk_idproducto = $item->fk_idproducto;
                $pedidoProducto->fk_idpedido = $pedido->idpedido;
                $pedidoProducto->cantidad = $item->cantidad;
                $pedidoProducto->insertar();
            }

            $carrito->eliminarPorCliente($idCliente);

            return view("web.pedido-gracias", compact("aSucursales", "aCarritos"));
        }
    }



    public function procesarMercadoPago($request)
    {

        SKD::setClientId(config("payment-methods.mercadopago.client"));
        SKD::setClientSecret(config("payment-methods.mercadopago.secret"));
        SKD::setAccessToken($access_token); // es el token de la cuenta de MP donde se depositara el pago


        $idCliente = Session::get("idCliente");
        $cliente = new Cliente();
        $cliente->obtenerPorId($idCliente);
        $idSucursal = $request->input("lstSucursal");
        $pago = $request->input("lstPago");
        $descripcion = $request->input("txtDescripcion");


     
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $total = 0;
        foreach ($aCarritos as $item) {
            $total += $item->cantidad * $item->precio;
        }

        $fecha = date("Y-m-d");

        //armado del producto item

        $item = new Item();
        $item->id = "1234";
        $item->tittle = "Burger SRL";
        $item->category_id = "products";
        $item->quantity = 1;
        $item->unit_price = $total;
        $item->currency_id = "ARS";

        $preference = new Preference();
        $preference->items = array($item);
        //datos del comprador

        $payer = new Payer();
        $payer->name = $cliente->nombre;
        $payer->surname = $cliente->apellido;
        $payer->email = $cliente->correo;
        $payer->date_created = date('Y-m-d H:m:s');
        $payer->identification = array(
            "type" => "DNI",
            "number" => $cliente->dni
        );


        $preference->payer = $payer;

        $pedido = new Pedido();
        $pedido->fk_idsucursal = $idSucursal;
        $pedido->fk_idcliente = $idCliente;
        $pedido->fk_idestado = 5;
        $pedido->descripcion = $descripcion;
        $pedido->fecha = $fecha;
        $pedido->total = $total;
        $pedido->pago = $pago;
        $pedido->insertar();


        $pedidoProducto = new Pedido_Producto();
        foreach ($aCarritos as $item) {
            $pedidoProducto->fk_idproducto = $item->fk_idproducto;
            $pedidoProducto->fk_idpedido = $pedido->idpedido;
            $pedidoProducto->cantidad = $item->cantidad;
            $pedidoProducto->insertar();
        }

        $carrito->eliminarPorCliente($idCliente);

        //URL de configuracion para indicarle a MP

        $preference->back_urls = [
            "success" => "http://120.0.0.1:8000/mercado-pago/aprobado/" . $pedido->idpedido,
            "pending" => "http://120.0.0.1:8000/mercado-pago/pendiente/" . $pedido->idpedido,
            "failure" => "http://120.0.0.1:8000/mercado-pago/error/" . $pedido->idpedido,
        ];
        $preference->payment_methods = array("installments" => 6);
        $preference->auto_return = "all";
        $preference->notification_url = '';
        $preference->save(); //ejecuta la transaccion

    }
}
