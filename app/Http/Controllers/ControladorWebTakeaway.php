<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Producto;
use App\Entidades\Categoria;
use Illuminate\Http\Request;
use Session;
class ControladorWebTakeaway extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();  
        $producto = new Producto();
        $aProductos = $producto->obtenerTodos();  
        $categoria = new Categoria();
        $aCategorias= $categoria->obtenerTodos();  
       
        return view("web.takeaway", compact( "aSucursales" , "aProductos", "aCategorias"));
           
    }


    public function insertar( Request $request)
{   $idCliente = Session::get("idCliente");
    $idProducto = $request->input("txtProducto");
    $cantidad=$request->input("txtCantidad");


    }
}
