<?php

require_once 'tablaclass.php';
//require_once 'centro.php';
/**
 * Description of sneajer
 *
 * @author dam
 */
class sneaker extends Tabla {

    //Las propiedades mapean las existentes en la base de datos
    private $idSNEAKER;
    private $brand;
    private $model;
    private $colorWay;
    private $dropDate;
    private $retailPrice;
    private $num_fields = 6;

    function __construct() {
        $show = ["idSNEAKER"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("SNEAKER", "idSNEAKER", $fields, $show);
    }

    function getIdSNEAKER() {
        return $this->idSNEAKER;
    }

    function getBrand() {
        return $this->brand;
    }
    function getModel(){
        return $this->model;
    }
    function getColorWay() {
        return $this->dropDate;
    }
    function getRetailPrice() {
        return $this->retailPrice;
    }
    function getEmail() {
        return $this->email;
    }
    function getPassword() {
        return $this->password;
    }
    function setId($idSNEAKER) {
        $this->idSNEAKER = $idSNEAKER;
    }
    function setName($brand) {
        $this->brand = $brand;
    }
    function setSurname($model) {
        $this->model = $model;
    }
    function setBirthdate($colorWay) {
        $this->colorWay = $colorWay;
    }
    function setAddress($retailPrice) {
        $this->retailPrice = $retailPrice;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function setPassword($password) {
        $this->password = $password;
    }

    function __get($brand) {
        $method = "get$brand";
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            throw new Exception("Property not found");
        }
    }

    function __set($brand, $value) {
        $method = "set$brand";
        if (method_exists($this, $method)) {
            return $this->$method($value);
        } else {
            throw new Exception("Property not found");
        }
    }

    function load($idSNEAKER) {
        
       $user = $this->getById($idSNEAKER);

       if (!empty($user)) {
           $this->idSNEAKER = $user['idSNEAKER'];
           $this->brand = $user['brand'];
           $this->model = $user['model'];
           $this->colorWay = $user['colorWay'];
           $this->retailPrice = $user['retailPrice'];
           $this->email = $user['email'];
           $this->password = $user['password'];
       } else {
           throw new Exception("Register doesnt exist, shit");
       }
   }
   function load2 ($idSNEAKER) {
    $user = $this->getById($idSNEAKER);
    if (!empty($user)) {
        $this->idSNEAKER = $user['idSNEAKER'];
        $this->brand = $user['brand'];
        $this->model = $user['model'];
        $this->colorWay = $user['colorWay'];
        $this->retailPrice = $user['retailPrice'];
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
   function updateUser($idSNEAKER, $valores){
       if (!empty($this->idSNEAKER)) {
           $this->update($this->idSNEAKER, $valores);
       }
   }
   function delete() {
        if (!empty($this->idSNEAKER)) {
            $this->deleteById($this->idSNEAKER);
            $this->idSNEAKER = null;
            $this->brand = null;
            $this->model = null;
            $this->colorWay = null;
            $this->retailPrice = null;
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
       unset($user['idSNEAKER']);
       
       if (empty($this->idSNEAKER)) {
           $this->insert($user);
           $this->idSNEAKER = self::$conn->lastInsertId();
       } else {
           $this->update($this->idSNEAKER, $user);
       }
   }
   function serialize() {
    return $this->valores();
    }
}/*
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
        }*/
