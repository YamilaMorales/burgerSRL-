<?php
namespace App\Entidades;



use DB;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;

    protected $fillable = [
        'idcliente', 'nombre', 'apellido', 'correo', 'dni', 'celular', 'clave', 'direccion',
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request) {
        $this->idcliente = $request->input('id') != "0" ? $request->input('id') : $this->idcliente;
        $this->nombre = $request->input('txtNombre');
        $this->apellido = $request->input('txtApellido');
        $this->correo = $request->input('txtCorreo');
        $this->dni = $request->input('txtDni');
        $this->celular = $request->input('txtCelular');
        $this->clave = password_hash($request->input('txtClave'), PASSWORD_DEFAULT);
        $this->direccion = $request->input('txtDireccion');
    }
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'nombre',
            1 => 'dni',
            2 => 'correo',
            3 => 'telefono',
        );
        $sql = "SELECT DISTINCT
                    idcliente,
                    nombre,
                    correo,
                    dni,
                    celular
                    FROM clientes
                   WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR correo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR dni LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR celular LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
    public function obtenerTodos()
    {
        $sql = "SELECT
                 idcliente,
                 nombre,
                 apellido,
                 correo,
                 dni,
                 celular,
                 clave,
                 direccion
                FROM clientes ORDER BY nombre ASC";

        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idcliente)
    {
        $sql = "SELECT
                 idcliente,
                 nombre,
                 apellido,
                 correo,
                 dni,
                 celular,
                 clave,
                 direccion
                FROM clientes WHERE idcliente = $idcliente";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->correo = $lstRetorno[0]->correo;
            $this->dni = $lstRetorno[0]->dni;
            $this->celular = $lstRetorno[0]->celular;
            $this->clave = $lstRetorno[0]->clave;
            $this->direccion = $lstRetorno[0]->direccion;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE clientes SET
            nombre='$this->nombre',
            apellido='$this->apellido',
            correo='$this->correo',
            dni='$this->dni',
            celular='$this->celular',
            clave='$this->clave',
            direccion='$this->direccion'
            WHERE idcliente=?";
        $affected = DB::update($sql, [$this->idcliente]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM clientes WHERE
            idcliente=?";
        $affected = DB::delete($sql, [$this->idcliente]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO clientes (
                nombre,
                apellido,
                correo,
                dni,
                celular,
                clave,
                direccion
            ) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->correo,
            $this->dni,
            $this->celular,
            $this->clave,
            $this->direccion
        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }

    public function obtenerPorCorreo($correo)
    {
        $sql = "SELECT
                 idcliente,
                 nombre,
                 apellido,
                 correo,
                 dni,
                 celular,
                 clave,
                 direccion
                FROM clientes WHERE correo = '$correo'";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->correo = $lstRetorno[0]->correo;
            $this->dni = $lstRetorno[0]->dni;
            $this->celular = $lstRetorno[0]->celular;
            $this->clave = $lstRetorno[0]->clave;
            $this->direccion = $lstRetorno[0]->direccion;
            return $this;
        }
        return null;
    }

}
    
?>