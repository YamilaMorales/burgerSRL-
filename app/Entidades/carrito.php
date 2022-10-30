<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carritos';
    public $timestamps = false;

    protected $fillable = [
        'idcliente', 'fk_idcliente', 'fk_idproducto'
    ];

    protected $hidden = [];
    private $producto;
    private $precio;
    private $cantidad;

    public function obtenerTodos()
    {
        $sql = "SELECT
                 idcarrito,
                fk_idcliente,
                fk_idproducto
                FROM carritos ORDER BY idcarrito ASC";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idCarrito)
    {
        $sql = "SELECT
                idcarrito,
                fk_idcliente,
                fk_idproducto
                FROM carritos WHERE idcarrito = $idCarrito";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarrito = $lstRetorno[0]->idcarrito;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE carritos SET
            fk_idcliente=$this->fk_idcliente,
            fk_idproducto=$this->fk_idproducto
          
            WHERE idcarrito=?";
        $affected = DB::update($sql, [$this->idcarrito]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM carritos WHERE
            idcarrito=?";
        $affected = DB::delete($sql, [$this->idcarrito]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO carritos (
                fk_idcliente,
                fk_idproducto
            ) VALUES (?,?);";
        $result = DB::insert($sql, [
            $this->fk_idcliente,
            $this->fk_idproducto,

        ]);
        return $this->idcarrito = DB::getPdo()->lastInsertId();
    }

    public function obtenerPorCliente($idCliente)
    {
        $sql = "SELECT
                  A.idcarrito,
                  A.fk_idcliente,
                  A.fk_idproducto,
                  B.nombre AS producto,
                  B.precio AS precio,
                  B.cantidad AS cantidad
                                       
                FROM carritos A
                    INNER JOIN productos B ON A.fk_idproducto = B.idproducto
                    
                   WHERE fk_idcliente = $idCliente";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
}
