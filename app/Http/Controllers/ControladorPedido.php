<?php

namespace App\Http\Controllers;


class ControladorPedido extends Controller
{
    public function nuevo()
    {
      $titulo = "Nuevo pedido";   
      return view("sistema.pedido-nuevo", compact("titulo"));
    }


    public function cargarDesdeRequest($request) {
      $this->idcliente = $request->input('id') != "0" ? $request->input('id') : $this->idcliente;
      $this->nombre = $request->input('txtNombre');
      $this->cantidad = $request->input('txtCantidad');
      $this->precio = $request->input('txtPrecio');
      $this->descripcion = $request->input('txtDescripcion');
      $this->celular = $request->input('txtCelular');
      $this->clave = $request->input('txtClave');
      $this->direccion = $request->input('txtDireccion');
  }
}
