<?php
require_once 'user.php';
/**
 * Description of tablaclass
 *
 * @author dam
 */
abstract class Tabla {

    static $server = "mysql-plugwalk.alwaysdata.net";
    static $user = "plugwalk";
    static $pass = "Plugwalk123*";
    static $database = "plugwalk_marcel";
    protected $table = 'USER';//Nombre de la tabla
    protected $idField = "idUser"; //Nombre del campo clave
    protected $fields;  //Array con los nombres de los campos (opcional)
    protected $showFields; //Array con los nombres de los campos a mostrar en determinadas consultas (opcional)
    static protected $conn;

    /**
     * El constructor necesita el nombre de la tabla y el nombre del campo clave
     * Opcionalmente podemos indicar los campos que tiene la tabla y aquellos que queremos mostrar
     * Cuando se haga una selección
     * @param type $table
     * @param type $idField
     * @param type $fields
     * @param type $showFields
     */
    public function __construct($table, $idField, $fields = "", $showFields = "") {
        $this->table = $table;
        $this->idField = $idField;
        $this->fields = $fields;
        $this->showFields = $showFields;
        self::conectar();
    }

    /**
     * Función de conexión
     */
    static function conectar() {
      //s  echo "conectar";
        try {
            self::$conn = new PDO("mysql:host=" . self::$server . ";dbname=" . self::$database, self::$user, self::$pass, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
        } catch (Exception $ex) {
            echo "TABLACLASS CONECTAR ERROR!";
            echo $ex->getMessage();
        }
        
    }

    /**
     * Getter de las propiedades
     * @param type $name
     * @return type
     */
    function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    /**
     * Setter de las propiedades
     * @param type $name
     * @param type $value
     * @throws Exception
     */
    function __set($name, $value) {
        if (property_exists($this, $name) && !empty($value)) {
            $this->$name = $value;
        } else {
            throw new Exception("Error: datos incorrectos");
        }
    }
    
    /**
     * Esta función nos devuelve el elemento de la tabla que tenga este id
     * @param int $id El id de la fila
     */
    protected function getById($id) {
        $res = self::$conn->query("select * from " . $this->table . " where "
                . $this->idField . "=" . $id);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Lo mismo que la anterior pero usando prepare
     * @param type $condicion
     * @param type $completo
     */
    function getAll($condicion = [], $completo = true) {
      
        $where = "";
        $campos = " * ";
        if (!empty($condicion)) {
            $where = " where " . join(" and ", array_map(function($v) {
                                return $v . "=:" . $v;
                            }, array_keys($condicion)));
        }
        if (!$completo && !empty($this->showFields)) {
            $campos = implode(",", $this->showFields);
        }
      //  echo "QUERY: ---"."select $campos from " . $this->table . $where." --   ";
        $st = self::$conn->prepare("select $campos from " . $this->table . $where);
        $st->execute($condicion);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Elimina el registro que tenga el id que le pasamos
     * @param int $id
     */
    protected function deleteById($id) {
        try {
            self::$conn->exec("delete from " . $this->table . " where "
                    . $this->idField . "=" . $id);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Esta función toma como parámetro un array asociativo y nos inserta en la tabla
     * un registro donde la clave del array hace referencia al campo de la tabla y
     * el valor del array al valor de la tabla.
     * ejemplo para la tabla actor: insert(['first_name'=>'Ana','last_name'=>'Pi'])
     * @param type $valores
     */
    protected function insert($valores) {
        try {
            $campos = join(",", array_keys($valores));
            $parametros = ":" . join(",:", array_keys($valores));
            $sql = "insert into " . $this->table . "($campos) values ($parametros)";
            $st = self::$conn->prepare($sql);
            $st->execute($valores);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Modifica el elemento de la base de datos con el id que pasamos
     * Con los valores del array asociativo
     * @param int $id Id del elemento a modificar
     * @param array $valores Array asociativo con los valores a modificar
     */
    protected function update($id, $valores) {
        try {
            //Creamos el cuerpo del select con la función array_map
            $campos = join(",", array_map(function($v) {
                        return $v . "=:" . $v;
                    }, array_keys($valores)));
            $sql = "update " . $this->table . " set " . $campos . " where "
                    . $this->idField . " = " . $id;
            $st = self::$conn->prepare($sql);
            $st->execute($valores);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
/*
     * Login
     *
     * @param $email, $password
     * @return $mixed
     * */
    public function Login($email, $password) {

        try {
            $query = self::$conn->prepare("SELECT id FROM USER WHERE  email=:email AND password=:password");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            // $enc_password = hash('sha256', $password);
            $query->bindParam("password", $password, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                return $result->id;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
 
    /*
     * get User Details
     *
     * @param $user_id
     * @return $mixed
     * */
    public function UserDetails($id) {
        try {
            $query = self::$conn->prepare("SELECT id, name, surname, email FROM user WHERE id=:id");
            $query->bindParam("id", $id, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    abstract function load($id);

    abstract function save();

    abstract function delete();
}
