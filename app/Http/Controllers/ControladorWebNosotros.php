<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Postulacion;
use App\Entidades\Carrito;
use Session;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorWebNosotros extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        return view("web.nosotros", compact("aSucursales", "aCarritos"));
    }

    public function insertarPostulacion(Request $request)
    {


        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);


        $entidad = new Postulacion();
        $entidad->nombre = $request->input("txtNombre");
        $entidad->apellido = $request->input("txtApellido");
        $entidad->celular = $request->input("txtCelular");
        $entidad->correo = $request->input("txtCorreo");
        $entidad->curriculum = $request->input("archivo");



        if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta el archivo
            $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
            $nombre = date("Ymdhmsi") . ".$extension";
            $archivo = $_FILES["archivo"]["tmp_name"];
            if ($extension == "doc" || $extension == "docx" || $extension == "pdf") {
                move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombre");
            } else {
                return "";
            }
            $entidad->curriculum = $nombre;
        }

        $entidad->insertar();

        return view("web.postulacion-gracias", compact("aSucursales", "aCarritos"));
    }
}
