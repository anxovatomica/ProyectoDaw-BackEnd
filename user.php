<?php

require_once 'tablaclass.php';
//require_once 'centro.php';
/**
 * Description of user
 *
 * @author dam
 */
class user extends Tabla {

    //Las propiedades mapean las existentes en la base de datos
    private $id;
    private $name;
    private $surname;
    private $birthdate;
    private $address;
    private $email;
    private $password;
    private $num_fields = 7;

    function __construct() {
        $show = ["name"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("user", "id", $fields, $show);
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }
    function getSurname(){
        return $this->surname;
    }
    function getBirthdate() {
        return $this->birthdate;
    }
    function getAddress() {
        return $this->address;
    }
    function getEmail() {
        return $this->email;
    }
    function getPassword() {
        return $this->password;
    }
    function setId($id) {
        $this->id = $id;
    }
    function setName($name) {
        $this->name = $name;
    }
    function setSurname($surname) {
        $this->surname = $surname;
    }
    function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }
    function setAddress($address) {
        $this->address = $address;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function setPassword($password) {
        $this->password = $password;
    }

    function __get($name) {
        $method = "get$name";
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            throw new Exception("Property not found");
        }
    }

    function __set($name, $value) {
        $method = "set$name";
        if (method_exists($this, $method)) {
            return $this->$method($value);
        } else {
            throw new Exception("Property not found");
        }
    }

    function load($id) {
        
       $user = $this->getById($id);

       if (!empty($user)) {
           $this->id = $user['id'];
           $this->name = $user['name'];
           $this->surname = $user['surname'];
           $this->birthdate = $user['birthdate'];
           $this->address = $user['address'];
           $this->email = $user['email'];
           $this->password = $user['password'];
       } else {
           throw new Exception("Register doesnt exist, shit");
       }
   }
   function load2 ($id) {
    $user = $this->getById($id);
    if (!empty($user)) {
        $this->id = $user['id'];
        $this->name = $user['name'];
        $this->surname = $user['surname'];
        $this->birthdate = $user['birthdate'];
        $this->address = $user['address'];
        $this->email = $user['email'];
        $this->password = $user['password'];
    } else {
        throw new Exception("Register doesnt exist, shit");
    }
    return $user;
   }
   function loadAll() {
        $user = $this->getAll();
        return $user;
   }
   function updateUser($id, $valores){
       if (!empty($this->id)) {
           $this->update($this->id, $valores);
       }
   }
   function delete() {
        if (!empty($this->id)) {
            $this->deleteById($this->id);
            $this->id = null;
            $this->name = null;
            $this->surname = null;
            $this->birthdate = null;
            $this->address = null;
            $this->email = null;
            $this->password = null;
        } else {
            throw new Exception("No hay registro para borrar");
        }
    }
   private function valores() {

       $valores = array_map(function($v) {
           return $this->$v;
       }, $this->fields);
       return array_combine($this->fields, $valores);
   }


   function save() {

       $user = $this->valores();
       unset($user['id']);
       
       if (empty($this->id)) {
           $this->insert($user);
           $this->id = self::$conn->lastInsertId();
       } else {
           $this->update($this->id, $user);
       }
   }
   function serialize() {
    return $this->valores();
    }
}
class HTTP {
    private $httpVersion = "HTTP/1.1";
    public function setHttpHeaders($statusCode,$response="") {
    $statusMessage = $this->getHttpStatusMessage($statusCode);
    header($this->httpVersion . " " . $statusCode . " " . $statusMessage);
    echo $response;
    }
    public function getHttpStatusMessage($statusCode) {
    $httpStatus = array(
    100 => 'Continue',
    101 => 'Switching Protocols',
    200 => 'OK',
    201 => 'Created',
    202 => 'Accepted',
    203 => 'Non-Authoritative Information',
    204 => 'No Content',
    205 => 'Reset Content',
    206 => 'Partial Content',
    300 => 'Multiple Choices',
    301 => 'Moved Permanently',
    302 => 'Found',
    303 => 'See Other',
    304 => 'Not Modified',
    305 => 'Use Proxy',
    306 => '(Unused)',
    307 => 'Temporary Redirect',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Request Entity Too Large',
    414 => 'Request-URI Too Long',
    415 => 'Unsupported Media Type',
    416 => 'Requested Range Not Satisfiable',
    417 => 'Expectation Failed',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout',
    505 => 'HTTP Version Not Supported');
    return ($httpStatus[$statusCode]) ? $httpStatus[$statusCode] : $status[500];
    }
    }
    class Response {
        public $message;
        public $data;
        function __construct($message, $data = "") {
        $this->message = $message;
        $this->data = $data;
        }
        function __toString() {
        return json_encode($this);
        }
        }
