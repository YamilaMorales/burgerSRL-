<?php
namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    public $timestamps = false;

    protected $fillable = [
        'idsucursal', 'nombre', 'direccion', 'telefono', 'horario', 'ubicacion', 
    ];

    protected $hidden = [

    ];
    
    public function cargarDesdeRequest($request) {
        $this->idsucursal = $request->input('id') != "0" ? $request->input('id') : $this->idsucursal;
        $this->nombre = $request->input('txtNombre');
        $this->direccion = $request->input('txtDireccion');
        $this->telefono = $request->input('txtTelefono');
        $this->horario = $request->input('txtHorario');
        $this->ubicacion = $request->input('txtUbicacion');
       
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                 idsucursal, 
                 nombre, 
                 direccion, 
                 telefono,
                 horario,
                 ubicacion
                FROM sucursales ORDER BY nombre ASC";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idSucursal)
    {
        $sql = "SELECT
                 idsucursal, 
                 nombre, 
                 direccion, 
                 telefono,
                 horario,
                 ubicacion
                FROM sucursales WHERE idsucursal = $idSucursal";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idsucursal = $lstRetorno[0]->idsucursal;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->horario = $lstRetorno[0]->horario;
            $this->ubicacion = $lstRetorno[0]->ubicacion;      
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE sucursales SET
            nombre='$this->nombre',
            direccion='$this->direccion',
            telefono='$this->telefono',
            horario='$this->horario',
            ubicacion='$this->ubicacion'
      
            WHERE idsucursal=?";
        $affected = DB::update($sql, [$this->idsucursal]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM sucursales WHERE
            idsucursal=?";
        $affected = DB::delete($sql, [$this->idsucursal]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO sucursales (
                 nombre, 
                 direccion, 
                 telefono,
                 horario,
                 ubicacion
            ) VALUES (?, ?, ?,?,?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->direccion,
            $this->telefono,
            $this->horario,
            $this->ubicacion,
        ]);
        return $this->idsucursal = DB::getPdo()->lastInsertId();
    }

    
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'nombre',
            1 => 'direccion',
            2 => 'horario',
            3 => 'telefono',
        );
        $sql = "SELECT DISTINCT
                    idsucursal,
                    nombre,
                    direccion,
                    horario,
                    telefono
                    
                    FROM sucursales
                   WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR direccion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR horario LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR telefono LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
}
    
?>