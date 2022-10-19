<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Pedido;
use App\Entidades\Estado;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;

require app_path() . '/start/constants.php';


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

    return view("sistema.pedido-nuevo", compact("titulo", "aEstados", "aSucursales", "aClientes"));
  }

  public function index()
  {
    $titulo = "Listado de pedidos";
    return view("sistema.pedido-listar", compact("titulo"));
  }

  public function guardar(Request $request)
  {

    try {
      //Define la entidad servicio
      $titulo = "Modificar pedido";
      $entidad = new Pedido();
      $entidad->cargarDesdeRequest($request);

      //validaciones
      if ($entidad->fecha == "" || $entidad->descripcion == "" || $entidad->total == "" || $entidad->fk_idsucursal == "" || $entidad->fk_idcliente == "" || $entidad->fk_idestado == "") {
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

  public function cargarGrilla(Request $request)
  {

    $request = $_REQUEST;

    $entidad = new Pedido();
    $aPedidos = $entidad->obtenerFiltrado();

    $data = array();
    $cont = 0;

    $inicio = $request['start'];
    $registros_por_pagina = $request['length'];


    for ($i = $inicio; $i < count($aPedidos) && $cont < $registros_por_pagina; $i++) {
      $row = array();
      $row[] = "<a href='/admin/pedido/" . $aPedidos[$i]->idpedido . "'>" . $aPedidos[$i]->fk_idcliente . "</a>";
      $row[] = $aPedidos[$i]->fecha;
      $row[] = $aPedidos[$i]->descripcion;
      $row[] = $aPedidos[$i]->total;
      $cont++;
      $data[] = $row;
    }

    $json_data = array(
      "draw" => intval($request['draw']),
      "recordsTotal" => count($aPedidos), //cantidad total de registros sin paginar
      "recordsFiltered" => count($aPedidos), //cantidad total de registros en la paginacion
      "data" => $data,
    );
    return json_encode($json_data);
  }

  public function editar($idPedido){

    $titulo = "Edición de pedido";
    $pedido = new Pedido();
    $estado = new Estado();
    $sucursal = new Sucursal();
    $cliente = new Cliente();
    $aClientes = $cliente->obtenerTodos();
    $aSucursales = $sucursal->obtenerTodos();
    $aEstados = $estado->obtenerTodos();
    $pedido->obtenerPorId($idPedido);
    return view( "sistema.pedido-nuevo" , compact( "titulo", "pedido", "aClientes","aSucursal","aEstado"));
}
}
