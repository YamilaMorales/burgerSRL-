<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [
        'idpedido', 'fecha', 'descripcion', 'total', 'fk_idsucursal', 'fk_idcliente', 'fk_idestado',
    ];

    protected $hidden = [];
    private $sucursal;
    private $cliente;
    private $estado;


    public function cargarDesdeRequest($request)
    {
        $this->idpedido = $request->input('id') != "0" ? $request->input('id') : $this->idpedido;
        $this->fecha = $request->input('txtFecha');
        $this->descripcion = $request->input('txtDescripcion');
        $this->total = $request->input('txtTotal');
        $this->fk_idestado = $request->input('lstEstado');
        $this->fk_idsucursal = $request->input('lstSucursal');
        $this->fk_idcliente = $request->input('lstCliente');
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                   idpedido,
                   fecha, 
                   descripcion,
                   total, 
                   fk_idsucursal, 
                   fk_idcliente, 
                   fk_idestado
                   
                FROM pedidos ORDER BY fecha DESC";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idPedido)
    {
        $sql = "SELECT
                   idpedido,
                   fecha, 
                   descripcion,
                   total, 
                   fk_idsucursal, 
                   fk_idcliente, 
                   fk_idestado
                FROM pedidos WHERE idpedido = $idPedido";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->total = $lstRetorno[0]->total;
            $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE pedidos SET
            fecha=$this->fecha,
            descripcion='$this->descripcion',
            total=$this->total,
            fk_idsucursal=$this->fk_idsucursal,
            fk_idcliente=$this->fk_idcliente,
            fk_idestado=$this->fk_idestado

            WHERE idpedido=?";
        $affected = DB::update($sql, [$this->idpedido]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedidos WHERE
            idpedido=?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedidos (
                   fecha, 
                   descripcion,
                   total, 
                   fk_idsucursal, 
                   fk_idcliente, 
                   fk_idestado
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fecha,
            $this->descripcion,
            $this->total,
            $this->fk_idsucursal,
            $this->fk_idcliente,
            $this->fk_idestado,
        ]);
        return $this->idpedido = DB::getPdo()->lastInsertId();
    }


    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'fk_idcliente',
            1 => 'fecha',
            2 => 'fk_idsucursal',
            3 => 'fk_idestado',
            4 => 'total',

        );
        $sql = "SELECT DISTINCT
                    A.idpedido,
                    A.fk_idestado,
                    A.fk_idcliente,
                    A.fecha,
                    A.fk_idsucursal,
                    A.total,
                    B.nombre AS sucursal,
                    C.nombre AS cliente,
                    D.nombre AS estado                   
                    FROM pedidos A
                    INNER JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                    INNER JOIN clientes C ON A.fk_idcliente = C.idcliente
                    INNER JOIN estados D ON A.fk_idestado = D.idestado
                   WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND fecha LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fk_idsucursal LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fk_idcliente LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fk_idestado LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR total LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }


    public function existePedidoPorCliente($idCliente)
    {
        $sql = "SELECT
                   idpedido,
                   fecha, 
                   descripcion,
                   total, 
                   fk_idsucursal, 
                   fk_idcliente, 
                   fk_idestado,
                    FROM pedidos 
                 WHERE fk_idcliente = $idCliente";
        $lstRetorno = DB::select($sql);

        return (count($lstRetorno) > 0);
    }
    public function existePedidoPorProducto($idProducto)
    {
        $sql = "SELECT
                   idcarrito_producto,
                   fk_idproducto,
                   fk_idcarrito,
                   cantidad
                FROM carrito_productos WHERE fk_idproducto = $idProducto";
        $lstRetorno = DB::select($sql);

        return (count($lstRetorno) > 0);
    }
    public function existePedidoPorSucursal($idSucursal)
    {
        $sql = "SELECT
                   idsucursal,
                   nombre,
                   direccion,
                   telefono,
                   ubicacion
                FROM sucursales WHERE idsucursal = $idSucursal";
        $lstRetorno = DB::select($sql);

        return (count($lstRetorno) > 0);
    }






    public function pedidoPorCliente($idCliente)
    {
        $sql = "SELECT 
                    A.idpedido,
                    A.fk_idestado,
                    A.fk_idcliente,
                    A.fecha,
                    A.fk_idsucursal,
                    A.total,
                    B.nombre AS sucursal,
                    D.nombre AS estado                   
                    FROM pedidos A
                    INNER JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                    INNER JOIN estados D ON A.fk_idestado = D.idestado
                   WHERE fk_idcliente = $idCliente
                ";

        $lstRetorno = DB::select($sql);

        return (count($lstRetorno) > 0);
    }
}
