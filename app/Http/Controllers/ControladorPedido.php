<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Pedido;
use App\Entidades\Estado;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
require app_path().'/start/constants.php';


class ControladorPedido extends Controller
{
    public function nuevo()
    {
      $titulo = "Nuevo pedido";   
      $estado = new Estado();
      $sucursal = new Sucursal();
      $cliente = new Cliente();
      $aClientes = $cliente->obtenerTodos();
      $aSucursales = $sucursal->obtenerTodos();
      $aEstados = $estado->obtenerTodos(); 

      return view("sistema.pedido-nuevo", compact("titulo" , "aEstados" , "aSucursales" , "aClientes"));
    }

    public function index()
    {
      $titulo = "Listado de pedidos";   
      return view("sistema.pedido-listar", compact("titulo"));
    }

    public function guardar(Request $request){

      try {
        //Define la entidad servicio
        $titulo = "Modificar pedido";
        $entidad = new Pedido();
        $entidad->cargarDesdeRequest($request);

        //validaciones
        if ($entidad->fecha == "" || $entidad->descripcion == "" || $entidad->total == "" || $entidad->fk_idsucursal == "" || $entidad->fk_idcliente == "" || $entidad->fk_idestado == "" ) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Complete todos los datos";
        } else {
            if ($_POST["id"] > 0) {
                //Es actualizacion
                $entidad->guardar();

                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;
            } else {
                //Es nuevo
                $entidad->insertar();

                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;
            }
            $_POST["id"] = $entidad->idpedido;
            return view('sistema.pedido-listar', compact('titulo', 'msg'));
            }
        
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }
      
        $id = $entidad->idpedido;
        $pedido = new Pedido();
        $pedido->obtenerPorId($id);

    return view('sistema.pedido-nuevo', compact('msg', 'cliente', 'titulo',)) . '?id=' . $pedido->idpedido;

} 

  }
