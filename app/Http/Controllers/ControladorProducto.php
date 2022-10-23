<?php

namespace App\Http\Controllers;
use App\Entidades\Producto;
use App\Entidades\Pedido;
use Illuminate\Http\Request;
use App\Entidades\Categoria;
require app_path().'/start/constants.php';

class ControladorProducto extends Controller
{
    public function nuevo()
    {
      $producto = new Producto();
      $titulo = "Nuevo producto"; 
      $categoria = new Categoria();
      $aCategorias = $categoria->obtenerTodos();  
      return view("sistema.producto-nuevo", compact("titulo" , "aCategorias" , "producto"));
    }
    public function index()
    {
      $titulo = "Listado de productos";   
      return view("sistema.producto-listar", compact("titulo"));
    
    }

    public function guardar(Request $request){

      try {

        //Define la entidad servicio
        $titulo = "Modificar producto";
        $entidad = new Producto();
        $entidad->cargarDesdeRequest($request);

        //validaciones
        if ($entidad->nombre == "" || $entidad->cantidad == "" || $entidad->precio == "" || $entidad->descripcion == "" || $entidad->categoria == "" ) {
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
            $_POST["id"] = $entidad->idproducto;
            return view('sistema.producto-listar', compact('titulo', 'msg'));
            }
        
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }
      
        $id = $entidad->idproducto;
        $producto = new Producto();
        $producto->obtenerPorId($id);

    return view('sistema.producto-nuevo', compact('msg', 'cliente', 'titulo',)) . '?id=' . $producto->idproducto;

} 



public function cargarGrilla( Request $request){

    $request = $_REQUEST;

    $entidad = new Producto();
    $aProductos = $entidad->obtenerFiltrado();

    $data = array();
    $cont = 0;

    $inicio = $request['start'];
    $registros_por_pagina = $request['length'];


    for ($i = $inicio; $i < count($aProductos) && $cont < $registros_por_pagina; $i++) {
        $row = array();
        $row[] ="<a href='/admin/producto/" . $aProductos[$i]->idproducto . "'>" . $aProductos[$i]->nombre . "</a>";
        $row[] = $aProductos[$i]->precio;
        $row[] = $aProductos[$i]->cantidad;
        $row[] = $aProductos[$i]->descripcion;
        $cont++;
        $data[] = $row;
    }

    $json_data = array(
        "draw" => intval($request['draw']),
        "recordsTotal" => count($aProductos), //cantidad total de registros sin paginar
        "recordsFiltered" => count($aProductos), //cantidad total de registros en la paginacion
        "data" => $data,
    );
    return json_encode($json_data);
}

public function editar($idProducto){

    $titulo = "Edición de producto";
    $producto = new Producto();
    $categoria = new Categoria();
    $aCategorias = $categoria->obtenerTodos(); 
    $producto->obtenerPorId($idProducto);
    return view( "sistema.producto-nuevo" , compact( "titulo", "producto" , "aCategorias"));
}

public function eliminar(Request $request){
    
    $idProducto = $request->input("id");
    $pedido = new Pedido();

    //si el cliente tiene un pedido asociado no se puede eliminar.
  if($pedido->existePedidoPorProducto($idProducto)){

    $resultado["err"] = EXIT_FAILURE;
    $resultado["mensaje"] = "No se puede eliminar un producto con pedidos asociados.";
  } else{
    //Si no tiene pedido asociado se puede elimnar
   
    $producto = new Producto();
    $producto->idproducto=$idProducto;
    $producto->eliminar();
    $resultado["err"] = EXIT_SUCCESS;
    $resultado["mensaje"] = "Registro eliminado exitosamente.";
  }
  return json_encode($resultado);

}
}
