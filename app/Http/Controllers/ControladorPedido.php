<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Pedido;
use App\Entidades\Producto;
use App\Entidades\Estado;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\Pedido_Producto;


require app_path() . '/start/constants.php';


class ControladorPedido extends Controller
{
  public function nuevo()
  {
    $pedido = new Pedido();
    $titulo = "Nuevo pedido";
    $estado = new Estado();
    $sucursal = new Sucursal();
    $cliente = new Cliente();
    $aClientes = $cliente->obtenerTodos();
    $aSucursales = $sucursal->obtenerTodos();
    $aEstados = $estado->obtenerTodos();
    
 
    if (Usuario::autenticado() == true) {
      if (!Patente::autorizarOperacion("PEDIDOALTA")) {
        $codigo = "PEDIDOALTA";
        $mensaje = "No tiene permisos para la operación.";
        return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
      } else {

        return view("sistema.pedido-nuevo", compact("titulo", "pedido", "aEstados", "aSucursales", "aClientes"));
      }
    } else {
      return redirect('admin/login');
    }
  }

  public function index()
  {
    $titulo = "Listado de pedidos";
    if (Usuario::autenticado() == true) {
      if (!Patente::autorizarOperacion("PEDIDOCONSULTA")) {
        $codigo = "PEDIDOCONSULTA";
        $mensaje = "No tiene permisos para la operación.";
        return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje', "pedido", "aEstados", "aSucursales", "aClientes"));
      } else {
        return view("sistema.pedido-listar", compact("titulo"));
      }
    } else {
      return redirect('admin/login');
    }
  }

  public function guardar(Request $request)
  {

    try {
      //Define la entidad servicio
      $titulo = "Modificar pedido";
      $entidad = new Pedido();
      $entidad->cargarDesdeRequest($request);
      $estado = new Estado();
      $sucursal = new Sucursal();
      $cliente = new Cliente();
      $aClientes = $cliente->obtenerTodos();
      $aSucursales = $sucursal->obtenerTodos();
      $aEstados = $estado->obtenerTodos();
      
     
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

    return view('sistema.pedido-nuevo', compact("msg", "titulo", "pedido", "aEstados", "aSucursales", "aClientes")) . '?id=' . $pedido->idpedido;
  }

  public function cargarGrilla(Request $request)
  {

    $request = $_REQUEST;



    $entidad = new Pedido();
    $aPedidos = $entidad->obtenerFiltrado();
    $entidad = new Cliente();
    
    $data = array();
    $cont = 0;

    $inicio = $request['start'];
    $registros_por_pagina = $request['length'];


    for ($i = $inicio; $i < count($aPedidos) && $cont < $registros_por_pagina; $i++) {
      $row = array();
      $row[] = "<a href='/admin/pedido/" .  $aPedidos[$i]->idpedido . "'>" . $aPedidos[$i]->cliente .  "</a>";
      $row[] = date_format(date_create($aPedidos[$i]->fecha),'d M Y');
      $row[] = $aPedidos[$i]->sucursal;
      $row[] = $aPedidos[$i]->estado;
      $row[] = number_format($aPedidos[$i]->total, 2, ",", ".");
      $row[] = $aPedidos[$i]->pago;
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

  public function editar($idPedido)
  {

    $titulo = "Modificar pedido";
    $pedido = new Pedido();
    $estado = new Estado();
    $sucursal = new Sucursal();
    $cliente = new Cliente();
    $aClientes = $cliente->obtenerTodos();
    $aSucursales = $sucursal->obtenerTodos();
    $aEstados = $estado->obtenerTodos();
    $pedido->obtenerPorId($idPedido);

    $entidadPedidoProductos = new Pedido_Producto();
    $aPedidoProductos = $entidadPedidoProductos->obtenerPorPedido($idPedido);


    if (Usuario::autenticado() == true) {
      if (!Patente::autorizarOperacion("PEDIDOEDITAR")) {
        $codigo = "PEDIDOEDITAR";
        $mensaje = "No tiene permisos para la operación.";
        return view('sistema.pagina-error', compact('codigo', 'mensaje'));
      } else {
        $titulo = "Modificar pedido";
        $pedido = new Pedido();
        $estado = new Estado();
        $sucursal = new Sucursal();
        $cliente = new Cliente();
        $aClientes = $cliente->obtenerTodos();
        $aSucursales = $sucursal->obtenerTodos();
        $aEstados = $estado->obtenerTodos();
        $pedido->obtenerPorId($idPedido);

        $entidadPedidoProducto = new Pedido_Producto();
        $aPedidoProductos = $entidadPedidoProducto->obtenerPorPedido($idPedido);

        return view("sistema.pedido-nuevo", compact("pedido", "aClientes", "aSucursales", "aEstados", "titulo","aPedidoProductos"));
      }
    } else {
      return redirect('admin/login');
    }
  }



  public function eliminar(Request $request)
  {
    if (Usuario::autenticado() == true) {
      if (!Patente::autorizarOperacion("PEDIDOBAJA")) {
        $resultado["err"] = EXIT_FAILURE;
        $resultado["mensaje"] =  "No tiene permisos para la operación.";
      } else {
       
        $idPedido = $request->input("id");
        $pedidoProdcuto= new Pedido_Producto();
        if ($pedidoProdcuto->existeProductoPorPedido($idPedido)) {

            $resultado["err"] = EXIT_FAILURE;
            $resultado["mensaje"] = "No se puede eliminar un pedido con productos asociados.";
          } else {
            //Si no tiene producto asociado se puede elimnar
    
            $pedido = new Pedido();
        $pedido->idpedido = $idPedido;
        $pedido->eliminar();
        $resultado["err"] = EXIT_SUCCESS;
        $resultado["mensaje"] = "Registro eliminado exitosamente.";
      }}
    } else {
      $resultado["err"] = EXIT_FAILURE;
      $resultado["mensaje"] = "Usuario no autenticado.";
    }
    return json_encode($resultado);
  }
}
