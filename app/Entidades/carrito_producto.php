<?php
namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class CarritoProducto extends Model
{
    protected $table = 'carrito_productos';
    public $timestamps = false;

    protected $fillable = [
      'idcarrito_producto','fk_idproducto', 'fk_idcarrito', 'cantidad',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                idcarrito_producto,
                fk_idproducto, 
                fk_idcarrito, 
                cantidad
                FROM carrito_productos ORDER BY nombre ASC";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idCarritoProducto)
    {
        $sql = "SELECT
                idcarrito_producto,
                fk_idproducto, 
                fk_idcarrito, 
                cantidad
                FROM carrito_productos WHERE idcarrito_producto = $idCarritoProducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarrito_producto = $lstRetorno[0]->idcarrito_producto;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->fk_idcarrito = $lstRetorno[0]->fk_idcarrito;
            $this->cantidad = $lstRetorno[0]->cantidad;
            
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE carrito_productos SET
            fk_idproducto = $this->fk_idproducto,
            fk_idcarrito = $this->fk_idcarrito,
            cantidad = $this->cantidad

          
            WHERE idcarrito_producto=?";
        $affected = DB::update($sql, [$this->idcarrito_producto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM carrito_productos WHERE
            idcarrito_producto=?";
        $affected = DB::delete($sql, [$this->idcarrito_producto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO carrito_productos (
                fk_idproducto, 
                fk_idcarrito, 
                cantidad
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idproducto,
            $this->ffk_idcarrito,
            $this->cantidad,
            
        ]);
        return $this->idcarrito_producto = DB::getPdo()->lastInsertId();
    }

}
    
?>