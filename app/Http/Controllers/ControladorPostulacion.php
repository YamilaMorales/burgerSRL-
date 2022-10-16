<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Postulacion;
require app_path().'/start/constants.php';

class ControladorPostulacion extends Controller
{
    public function nuevo()
    {
      $titulo = "Nueva postulacion";   
      return view("sistema.postulacion-nuevo", compact("titulo"));
    }


    public function guardar(Request $request){

      $producto = new Postulacion();
      $producto->cargarDesdeRequest($request);

      try {
        //Define la entidad servicio
        $titulo = "Modificar postulacion";
        $entidad = new Postulacion();
        $entidad->cargarDesdeRequest($request);

        //validaciones
        if ($entidad->nombre == "" || $entidad->apellido== "" || $entidad->celular== "" || $entidad->correo == "" || $entidad->curriculum == "" ) {
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
            $_POST["id"] = $entidad->idpostulacion;
            return view('sistema.postulacion-listar', compact('titulo', 'msg'));
            }
        
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }
      
        $id = $entidad->idpostulacion;
        $postulacion = new Postulacion();
        $postulacion->obtenerPorId($id);

    return view('sistema.postulacion-nuevo', compact('msg', 'cliente', 'titulo',)) . '?id=' . $postulacion->idpostulacion;

} 


}
?>