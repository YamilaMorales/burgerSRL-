<?php

namespace App\Http\Controllers;


class ControladorProducto extends Controller
{
    public function nuevo()
    {
      $titulo = "Nuevo producto";   
      return view("sistema.cliente-nuevo", compact("titulo"));
    }
}
?>