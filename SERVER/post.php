<?php

require_once 'tablaclass.php';
//require_once 'centro.php';
/**
 * Description of sneajer
 *
 * @author marcel
 */
class post extends Tabla {

    //Las propiedades mapean las existentes en la base de datos
    private $idPOST;
    private $topic;
    private $date;
    private $iduser;
    private $title;
    private $body;
    private $num_fields = 6;

    function __construct() {
        $show = ["idPOST"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("POST", "idPOST", $fields, $show);
    }

    function getIdPOST() {
        return $this->idPOST;
    }

    function getTopic() {
        return $this->topic;
    }
    function getDate(){
        return $this->date;
    }
    function getIduser() {
        return $this->iduser;
    }
    function getTitle() {
        return $this->title;
    }
    function getBody() {
        return $this->body;
    }
    function setTitle($title) {
        $this->title = $title;
    }
    function setBody($body) {
        $this->body = $body;
    }
    function setIdPost($idPOST) {
        $this->idPOST = $idPOST;
    }
    function setTopic($topic) {
        $this->topic = $topic;
    }
    function setDate($date) {
        $this->date = $date;
    }
    function setIduser($iduser) {
        $this->iduser = $iduser;
    }

    function __get($topic) {
        $method = "get$topic";
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            throw new Exception("Property not found");
        }
    }

    function __set($topic, $value) {
        $method = "set$topic";
        if (method_exists($this, $method)) {
            return $this->$method($value);
        } else {
            throw new Exception("Property not found");
        }
    }

    function load($idPOST) {
        
       $user = $this->getById($idPOST);

       if (!empty($user)) {
           $this->idPOST = $user['idPOST'];
           $this->topic = $user['topic'];
           $this->date = $user['date'];
           $this->iduser = $user['iduser'];
       } else {
           throw new Exception("Register doesnt exist, shit");
       }
   }
   function load2 ($idPOST) {
    $user = $this->getById($idPOST);
    if (!empty($user)) {
        $this->idPOST = $user['idPOST'];
        $this->topic = $user['topic'];
        $this->date = $user['date'];
        $this->USER_idUSER = $user['iduser'];
    } else {
        throw new Exception("Register doesnt exist, shit");
    }
    return $user;
   }
   function loadAll() {
        $user = $this->getAll();
        return $user;
   }
   function updateUser($idPOST, $valores){
       if (!empty($this->idPOST)) {
           $this->update($this->idPOST, $valores);
       }
   }
   function delete() {
        if (!empty($this->idPOST)) {
            $this->deleteById($this->idPOST);
            $this->idPOST = null;
            $this->topic = null;
            $this->date = null;
            $this->iduser = null;
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
       unset($user['idPOST']);
       
       if (empty($this->idPOST)) {
           $this->insert($user);
           $this->idPOST = self::$conn->lastInsertId();
       } else {
           $this->update($this->idPOST, $user);
       }
   }
   function serialize() {
    return $this->valores();
    }
}
