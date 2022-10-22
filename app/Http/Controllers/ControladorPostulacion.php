<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Postulacion;
require app_path().'/start/constants.php';

class ControladorPostulacion extends Controller
{
    public function nuevo()
    {
      $postulacion = new Postulacion();
      $titulo = "Nueva postulacion";   
      return view("sistema.postulacion-nuevo", compact("titulo","postulacion"));
    }
    public function index()
    {
      $titulo = "Listado de postulaciones";   
      return view("sistema.postulacion-listar", compact("titulo"));
    
    }
    public function guardar(Request $request){

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



public function cargarGrilla(Request $request)
{

  $request = $_REQUEST;

  $entidad = new Postulacion();
  $aPostulacion = $entidad->obtenerFiltrado();

  $data = array();
  $cont = 0;

  $inicio = $request['start'];
  $registros_por_pagina = $request['length'];


  for ($i = $inicio; $i < count($aPostulacion) && $cont < $registros_por_pagina; $i++) {
    $row = array();
    $row[] = "<a href='/admin/postulacion/" . $aPostulacion[$i]->idpostulacion . "'>" . $aPostulacion[$i]->nombre . "</a>";
    $row[] = $aPostulacion[$i]->apellido;
    $row[] = $aPostulacion[$i]->celular;
    $row[] = $aPostulacion[$i]->correo;
    $row[] =  "<a href= ''> Descargar </a>";
    $cont++;
    $data[] = $row;
  }

  $json_data = array(
    "draw" => intval($request['draw']),
    "recordsTotal" => count($aPostulacion), //cantidad total de registros sin paginar
    "recordsFiltered" => count($aPostulacion), //cantidad total de registros en la paginacion
    "data" => $data,
  );
  return json_encode($json_data);
}

public function editar($idPostulacion){

  $titulo = "Edición de postulaciones";
  $postulacion = new Postulacion();
  $postulacion->obtenerPorId($idPostulacion);
  return view( "sistema.postulacion-nuevo" , compact( "titulo", "postulacion"));
}
}
