<?php

namespace App\Http\Controllers;

use App\Entidades\Proveedor;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Sistema\Patente;

require app_path() . '/start/constants.php';

class ControladorProveedor extends Controller
{
  public function nuevo()
  {
    $proveedor = new Proveedor();
    $titulo = "Nuevo proveedor";
    if (Usuario::autenticado() == true) {
      if (!Patente::autorizarOperacion("PROVEEDORESALTA")) {
        $codigo = "PROVEEDORESALTA";
        $mensaje = "No tiene permisos para la operación.";
        return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
      } else {
        return view("sistema.proveedor-nuevo", compact("titulo", "proveedor"));
      }
    } else {
      return redirect('admin/login');
    }
  }

  public function index()
  {
    $titulo = "Listado de proveedores";
    if (Usuario::autenticado() == true) {
      if (!Patente::autorizarOperacion("PROVEEDORESCONSULTA")) {
        $codigo = "PROVEEDORESCONSULTA";
        $mensaje = "No tiene permisos para la operación.";
        return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
      } else {

        return view("sistema.proveedor-listar", compact("titulo"));
      }
    } else {
      return redirect('admin/login');
    }
  }
  public function guardar(Request $request)
  {

    try {
      //Define la entidad servicio
      $titulo = "Modificar proveedor";
      $entidad = new Proveedor();
      $entidad->cargarDesdeRequest($request);

      //validaciones
      if ($entidad->nombre ==  "") {
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
        $_POST["id"] = $entidad->idproveedor;
        return view('sistema.proveedor-listar', compact('titulo', 'msg'));
      }
    } catch (Exception $e) {
      $msg["ESTADO"] = MSG_ERROR;
      $msg["MSG"] = ERRORINSERT;
    }

    $id = $entidad->idproveedor;
    $proveedor = new Proveedor();
    $proveedor->obtenerPorId($id);

    return view('sistema.proveedor-nuevo', compact('msg', 'titulo', 'proveedor')) . '?id=' . $proveedor->idproveedor;
  }


  public function cargarGrilla(Request $request)
  {

    $request = $_REQUEST;

    $entidad = new Proveedor();
    $aProveedores = $entidad->obtenerFiltrado();

    $data = array();
    $cont = 0;

    $inicio = $request['start'];
    $registros_por_pagina = $request['length'];


    for ($i = $inicio; $i < count($aProveedores) && $cont < $registros_por_pagina; $i++) {
      $row = array();
      $row[] = "<a href='/admin/proveedor/nuevo" . $aProveedores[$i]->idproveedor . "'>" . $aProveedores[$i]->nombre . "</a>";
      $row[] = $aProveedores[$i]->telefono;
      $cont++;
      $data[] = $row;
    }

    $json_data = array(
      "draw" => intval($request['draw']),
      "recordsTotal" => count($aProveedores), //cantidad total de registros sin paginar
      "recordsFiltered" => count($aProveedores), //cantidad total de registros en la paginacion
      "data" => $data,
    );
    return json_encode($json_data);
  }

  public function editar($idProveedor)
  {

    $titulo = "Edición de proveedor";
   
    if (Usuario::autenticado() == true) {
      if (!Patente::autorizarOperacion("PROVEEDOREDITAR")) {
        $codigo = "PROVEEDOREDITAR";
        $mensaje = "No tiene permisos para la operación.";
        return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
      } else {
        $proveedor = new Proveedor();
        $proveedor->obtenerPorId($idProveedor);
        return view("sistema.proveedor-nuevo", compact("titulo", "proveedor"));
      }
    } else {
      return redirect('admin/login');
    }
  }

  public function eliminar(Request $request)
  {

    if (Usuario::autenticado() == true) {
      if (!Patente::autorizarOperacion("PROVEEDORELIMINAR")) {
        $resultado["err"] = EXIT_FAILURE;
        $resultado["mensaje"] =  "No tiene permisos para la operación.";
      } else {
        $idProveedor = $request->input("id");
        $proveedor = new Proveedor();


        $proveedor->idproveedor = $idProveedor;
        $proveedor->eliminar();
        $resultado["err"] = EXIT_SUCCESS;
        $resultado["mensaje"] = "Registro eliminado exitosamente.";
      }
    } else {
      $resultado["err"] = EXIT_FAILURE;
      $resultado["mensaje"] = "Usuario no autenticado.";
    }
    return json_encode($resultado);
  }
}
