<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use App\Entidades\Cliente;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Session;

class ControladorWebRecuperarClave extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $titulo = "Sucursales"; 
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.recuperar-clave", compact("titulo" , "aSucursales" , "sucursal"));
            
    }


    public function recuperar(Request $request){
        $titulo='Recupero de clave';
        $correo= $request->input('txtCorreo');
        $clave= rand(1000,9999);
        $cliente = new Cliente();
        $cliente->obtenerPorCorreo($correo);
        if($cliente->correo!= ""){
            

            $data = "Instrucciones";

            $correo = new PHPMailer(true);                              
            try {
                //Server settings
                $correo->SMTPDebug = 0;                                 
                $correo->isSMTP();                                     
                $correo->Host = env('MAIL_HOST');  
                $correo->SMTPAuth = true;                               
                $correo->Username = env('MAIL_USERNAME');                 
                $correo->Password = env('MAIL_PASSWORD');                           
                $correo->SMTPSecure = env('MAIL_ENCRYPTION');                           
                $correo->Port = env('MAIL_PORT');                                    

                //Recipients
                $correo->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $correo->addAddress($correo);               
               

                //Content
                $correo->isHTML(true);
                $correo->Subject = 'Recupero de clave';
                $correo->Body    = "Los datos de acceso son:
                Usuario: $cliente->correo
                Clave: $clave 

                ";
                $entidad= new Cliente();
                $entidad->guardar();
                $entidad->correo = $request->input("txtCorreo");
                $entidad->clave = password_hash($request->input("txtClave"), PASSWORD_DEFAULT);
               

                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = "Registro Exitoso.";
                //$mail->send();
                $mensaje = "Tu nueva clave es $clave ";
                
                return view('web.recuperar-clave', compact('titulo', 'mensaje'));

            } catch (Exception $e) {
                $mensaje = "Hubo un error al enviar el correo.";
                return view('web.recuperar-clave', compact('titulo', 'mensaje'));
            }  
        } else {
            $mensaje = "El email es incorrecto.";
            return view('web.recuperar-clave', compact('titulo', 'mensaje'));
        }
    }

}