<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Carrito;
use App\Entidades\Pedido;
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
    
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $cantidad = $request->input("txtCantidad");
        $idCarrito = $request->input("txtCarrito");
        $idProducto = $request->input("txtProducto");
       
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $carrito = new Carrito();
        $carrito->cantidad = $cantidad;
        $carrito->fk_idcliente =$idCliente;
        $carrito->fk_idproducto=$idCliente;
        $carrito->guardar();
        $msg["ESTADO"] = EXIT_SUCCESS;
        $msg["MSG"] = "Producto actualizado con exito.";
        return view('web.carrito', compact('msg',  'aSucursales', 'aCarritos'));

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
        return view('web.carrito', compact('msg',  'aSucursales', 'aCarritos'));
    }

    public function insertarPedido(Request $request)
    {
        $idCliente=Session::get("idCliente");
        $sucursal = new Sucursal(); 
        $aSucursales = $sucursal->obtenerTodos();

       $pedido= new Pedido();
       $pedido->fecha= $request->input("txtNombre");
       $pedido->descripcion= $request->input("txtApellido");
       $pedido->total= $request->input("txtCelular");
       $pedido->fk_idsucursal= $request->input("");
       $pedido->fk_idcliente= "";
       $pedido->fk_idestado= $request->input("txtCorreo");

       $pedido->insertar();
       
       return view("web.postulacion-gracias", compact("aSucursales" ));
        

    }
}
