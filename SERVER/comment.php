<?php

require_once 'tablaclass.php';
//require_once 'centro.php';
/**
 * Description of comment
 *
 * @author dam
 */
class comment extends Tabla {

    //Las propiedades mapean las existentes en la base de datos
    private $idComment;
    private $idUser;
    private $idPost;
    private $date;
    private $num_fields = 4;

    function __construct() {
        $show = ["idComment"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("COMMENT", "idComment", $fields, $show);
    }

    function getIdComment() {
        return $this->idComment;
    }
    function getIdUser() {
        return $this->idUser;
    }
    function getIdPost(){
        return $this->idPost;
    }
    function getDate(){
        return $this->date;
    }
    function setIdComment($idComment) {
        $this->idComment = $idComment;
    }
    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }
    function setIdPost($idPost) {
        $this->idPost = $idPost;
    }
    function setDate($date) {
        $this->date = $date;
    }

    function __get($idUser) {
        $method = "get$idUser";
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            throw new Exception("Property not found");
        }
    }

    function __set($idUser, $value) {
        $method = "set$idUser";
        if (method_exists($this, $method)) {
            return $this->$method($value);
        } else {
            throw new Exception("Property not found");
        }
    }

    function load($idComment) {
        
       $user = $this->getById($idComment);

       if (!empty($user)) {
           $this->idComment = $user['idComment'];
           $this->idUser = $user['idUser'];
           $this->idPost = $user['idPost'];
           $this->date = $user['date'];
       } else {
           throw new Exception("Register doesnt exist, shit");
       }
   }
   function load2 ($idComment) {
    $user = $this->getById($idComment);
    if (!empty($user)) {
        $this->idComment = $user['idComment'];
        $this->idUser = $user['idUser'];
        $this->idPost = $user['idPost'];
        $this->date = $user['date'];
    } else {
        throw new Exception("Register doesnt exist, shit");
    }
    return $user;
   }
   function loadAll() {
        $user = $this->getAll();
        return $user;
   }
   function updateUser($idComment, $valores){
       if (!empty($this->idComment)) {
           $this->update($this->idComment, $valores);
       }
   }
   function delete() {
        if (!empty($this->idComment)) {
            $this->deleteById($this->idComment);
            $this->idComment = null;
            $this->idUser = null;
            $this->idPost = null;
            $this->date = null;
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
       unset($user['idComment']);
       
       if (empty($this->idComment)) {
           $this->insert($user);
           $this->idComment = self::$conn->lastInsertId();
       } else {
           $this->update($this->idComment, $user);
       }
   }
   function serialize() {
    return $this->valores();
    }
}
