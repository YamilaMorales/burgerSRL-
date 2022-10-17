<?php

namespace App\Http\Controllers;
use App\Entidades\Cliente;
use Illuminate\Http\Request;
require app_path().'/start/constants.php';

class ControladorCliente extends Controller
{
    public function nuevo()
    {
      $titulo = "Nuevo cliente";   
      return view("sistema.cliente-nuevo", compact("titulo"));
    }

    public function index()
    {
      $titulo = "Listado de  clientes";   
      return view("sistema.cliente-listar", compact("titulo"));
    }

    public function guardar(Request $request){

          try {
            //Define la entidad servicio
            $titulo = "Modificar cliente";
            $entidad = new Cliente();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "" || $entidad->apellido == "" || $entidad->dni == "" || $entidad->correo == "" || $entidad->celular == "" || $entidad->clave == "" || $entidad->direccion == "" ) {
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
                $_POST["id"] = $entidad->idcliente;
                return view('sistema.cliente-listar', compact('titulo', 'msg'));
                }
            
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }
          
            $id = $entidad->idcliente;
            $cliente = new Cliente();
            $cliente->obtenerPorId($id);
    
        return view('sistema.cliente-nuevo', compact('msg', 'cliente', 'titulo',)) . '?id=' . $cliente->idcliente;

    } 
    
}

?>