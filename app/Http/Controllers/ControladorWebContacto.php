<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sucursal;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require app_path() . '/start/constants.php';
class ControladorWebContacto extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        return view("web.contacto", compact("aSucursales", "sucursal"));
    }

    public function enviar(Request $request)
    {

        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();


        $nombre = $request->input("txtNombre");
        $telefono = $request->input("txtTelefono");
        $correo = $request->input("txtCorreo");
        $mensaje = $request->input("txtMensaje");

        if ($nombre != "" && $correo != "" && $telefono != "" && $mensaje != "") {



            $data = "Instrucciones";

            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = env('MAIL_HOST');
                $mail->SMTPAuth = true;
                $mail->Username = env('MAIL_USERNAME');
                $mail->Password = env('MAIL_PASSWORD');
                $mail->SMTPSecure = env('MAIL_ENCRYPTION');
                $mail->Port = env('MAIL_PORT');

                //Recipients
                $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->addAddress($correo);


                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Contacto';
                $mail->Body    = "Los datos del formulario son:
                Nombre: $nombre<br>
                Telefono: $telefono<br>
                Email: $correo<br>
                Mensaje: $mensaje<br>

                ";



                //$mail->send();

                return view('web.contacto-gracias', compact("aSucursales"));
                
            } catch (Exception $e) {
                $mensaje["ESTADO"] = MSG_ERROR;
                $mensaje["MSG"] = "Hubo un error al enviar el correo";
                return view("web.contacto", compact('mensaje', 'aSucursales'));
            }
        } else {

            $mensaje["ESTADO"] = MSG_ERROR;
            $mensaje["MSG"] = "Complete todos los datos";
            return view("web.contacto", compact('mensaje', 'aSucursales'));
        }
    }
}
