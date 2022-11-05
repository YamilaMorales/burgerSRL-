<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use App\Entidades\Cliente;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ControladorWebRecuperarClave extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal(); 
        $aSucursales = $sucursal->obtenerTodos();  
        return view("web.recuperar-clave", compact(  "aSucursales" ));
            
    }


    public function recuperar(Request $request){
    
     $correo= $request->input('txtCorreo');
        $clave= rand(1000,9999);
        $cliente = new Cliente();
        $cliente->obtenerPorCorreo($correo);
        if($cliente->correo!= ""){
            

            $data = "Instrucciones";

            $email = new PHPMailer(true);                              
            try {
                //Server settings
                $email->SMTPDebug = 0;                                 
                $email->isSMTP();                                     
                $email->Host = env('MAIL_HOST');  
                $email->SMTPAuth = true;                               
                $email->Username = env('MAIL_USERNAME');                 
                $email->Password = env('MAIL_PASSWORD');                           
                $email->SMTPSecure = env('MAIL_ENCRYPTION');                           
                $email->Port = env('MAIL_PORT');                                    

                //Recipients
                $email->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $email->addAddress($correo);               
               

                //Content
                $email->isHTML(true);
                $email->Subject = 'Recupero de clave';
                $email->Body    = "Los datos de acceso son:
                Usuario: $cliente->correo
                Clave: $clave 

                ";
            
                $cliente->insertar();
                $cliente->correo = $request->input("txtCorreo");
                $cliente->clave = password_hash($request->input("txtClave"), PASSWORD_DEFAULT);
                $msg["ESTADO"] = MSG_SUCCESS;
                $msg["MSG"] = OKINSERT;
              
               

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