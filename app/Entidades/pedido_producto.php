<?php
namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    protected $table = 'pedidos_productos';
    public $timestamps = false;

    protected $fillable = [
        'idpedidoproducto', 'fk_idpedido', 'fk_idproducto', 'cantidad', 'precio_unitario',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                idpedidoproducto, 
                fk_idpedido, 
                fk_idproducto, 
                cantidad, 
                precio_unitario

                FROM pedidos_productos ORDER BY nombre ASC";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idPedidoProducto)
    {
        $sql = "SELECT
                idpedidoproducto, 
                fk_idpedido, 
                fk_idproducto, 
                cantidad, 
                precio_unitario

                FROM pedidos_productos WHERE idpedidoproducto = $idPedidoProducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedidoproducto = $lstRetorno[0]->idpedidoproducto;
            $this->fk_idpedido = $lstRetorno[0]->fk_idpedido;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->cantidad= $lstRetorno[0]->cantidad;
            $this->precio_unitario = $lstRetorno[0]->precio_unitario;
      
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE pedidos_productos SET
            fk_idpedido=$this->fk_idpedido,
            fk_idproducto =$this->fk_idproducto ,
            cantidad=$this->cantidad,
            precio_unitario=$this->precio_unitario,
           
            WHERE idpedidoproducto=?";
        $affected = DB::update($sql, [$this->idpedidoproducto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedidos_productos WHERE
            idpedidoproducto=?";
        $affected = DB::delete($sql, [$this-> idpedidoproducto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedidos_productos (
                fk_idpedido, 
                fk_idproducto, 
                cantidad, 
                precio_unitario

            ) VALUES (?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idpedido,
            $this->fk_idproducto,
            $this->cantidad,
            $this->precio_unitario,
            
        ]);
        return $this->idpedidoproducto = DB::getPdo()->lastInsertId();
    }

}
    
?>