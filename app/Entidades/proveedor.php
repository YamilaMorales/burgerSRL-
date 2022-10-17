<?php
namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    public $timestamps = false;

    protected $fillable = [
        'idproveedor', 'nombre', 'telefono'
    ];

    protected $hidden = [

    ];

 public function cargarDesdeRequest($request) {
        $this->idproveedor = $request->input('id') != "0" ? $request->input('id') : $this->idproveedor;
        $this->nombre = $request->input('txtNombre');
        $this->nombre = $request->input('txtTelefono');
       
       
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                 idproveedor,
                 nombre,
                 telefono
                FROM proveedores ORDER BY nombre ASC";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idProveedor)
    {
        $sql = "SELECT
                idproveedor,
                nombre,
                telefono
                FROM proveedores WHERE idproveedor = $idProveedor";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcategoria = $lstRetorno[0]->idcategoria;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->telefono = $lstRetorno[0]->telefono;

            
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE proveedores SET
            nombre='$this->nombre',
            nombre='$this->telefono'
            WHERE idproveedor=?";
        $affected = DB::update($sql, [$this->idproveedor]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM proveedores WHERE
            idproveedor=?";
        $affected = DB::delete($sql, [$this->idcategoria]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO proveedores (
                nombre,
                telefono
            ) VALUES (?, ? );";
        $result = DB::insert($sql, [
            $this->nombre,
            
        ]);
        return $this->idproveedor = DB::getPdo()->lastInsertId();
    }

}
    
?>