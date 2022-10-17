<?php

namespace App\Http\Controllers;
use App\Entidades\Producto;
use Illuminate\Http\Request;
use App\Entidades\Categoria;
require app_path().'/start/constants.php';

class ControladorProducto extends Controller
{
    public function nuevo()
    {
      $titulo = "Nuevo producto"; 
      $categoria = new Categoria();
      $aCategorias = $categoria->obtenerTodos();  
      return view("sistema.producto-nuevo", compact("titulo" , "aCategorias"));
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
        if ($entidad->nombre == "" || $entidad->cantidad == "" || $entidad->precio == "" || $entidad->imagen == "" || $entidad->descripcion == "" || $entidad->categoria == "" ) {
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

}
?>