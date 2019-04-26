<?php

require_once 'tablaclass.php';
//require_once 'centro.php';
/**
 * Description of sneajer
 *
 * @author dam
 */
class raffle extends Tabla {

    //Las propiedades mapean las existentes en la base de datos
    //sneakerID	pricePerEntry	totalPrice	USER_idUSER	SNEAKER_idSNEAKER
    private $idRAFFLE;
    private $sneakerID;
    private $pricePerEntry;
    private $USER_idUSER;
    private $SNEAKER_idSNEAKER;
    private $num_fields = 5;

    function __construct() {
        $show = ["idRAFFLE"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
        parent::__construct("RAFFLE", "idRAFFLE", $fields, $show);
    }

    function getidRAFFLE() {
        return $this->idRAFFLE;
    }

    function getsneakerID() {
        return $this->sneakerID;
    }
    function getpricePerEntry(){
        return $this->pricePerEntry;
    }
    function getUSER_idUSER() {
        return $this->USER_idUSER;
    }
    function getSNEAKER_idSNEAKER() {
        return $this->SNEAKER_idSNEAKER;
    }
    function setId($idRAFFLE) {
        $this->idRAFFLE = $idRAFFLE;
    }
    function setsneakerID($sneakerID) {
        $this->sneakerID = $sneakerID;
    }
    function sepricePerEntry($pricePerEntry) {
        $this->pricePerEntry = $pricePerEntry;
    }
    function setUSER_idUSER($USER_idUSER) {
        $this->USER_idUSER = $USER_idUSER;
    }
    function setSNEAKER_idSNEAKER($SNEAKER_idSNEAKER) {
        $this->SNEAKER_idSNEAKER = $SNEAKER_idSNEAKER;
    }
    function __get($sneakerID) {
        $method = "get$sneakerID";
        if (method_exists($this, $method)) {
            return $this->$method();
        } else {
            throw new Exception("Property not found");
        }
    }

    function __set($sneakerID, $value) {
        $method = "set$sneakerID";
        if (method_exists($this, $method)) {
            return $this->$method($value);
        } else {
            throw new Exception("Property not found");
        }
    }

    function load($idRAFFLE) {
        
       $user = $this->getById($idRAFFLE);

       if (!empty($user)) {
           $this->idRAFFLE = $user['idRAFFLE'];
           $this->sneakerID = $user['sneakerID'];
           $this->pricePerEntry = $user['pricePerEntry'];
           $this->USER_idUSER = $user['USER_idUSER'];
       } else {
           throw new Exception("Register doesnt exist, shit");
       }
   }
   function load2 ($idRAFFLE) {
    $user = $this->getById($idRAFFLE);
    if (!empty($user)) {
        $this->idRAFFLE = $user['idRAFFLE'];
        $this->sneakerID = $user['sneakerID'];
        $this->pricePerEntry = $user['pricePerEntry'];
        $this->USER_idUSER = $user['USER_idUSER'];
    } else {
        throw new Exception("Register doesnt exist, shit");
    }
    return $user;
   }
   function loadAll() {
        $user = $this->getAll();
        return $user;
   }
   function uppricePerEntryUser($idRAFFLE, $valores){
       if (!empty($this->idRAFFLE)) {
           $this->uppricePerEntry($this->idRAFFLE, $valores);
       }
   }
   function delete() {
        if (!empty($this->idRAFFLE)) {
            $this->deleteById($this->idRAFFLE);
            $this->idRAFFLE = null;
            $this->sneakerID = null;
            $this->pricePerEntry = null;
            $this->USER_idUSER = null;
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
       unset($user['idRAFFLE']);
       
       if (empty($this->idRAFFLE)) {
           $this->insert($user);
           $this->idRAFFLE = self::$conn->lastInsertId();
       } else {
           $this->uppricePerEntry($this->idRAFFLE, $user);
       }
   }
   function serialize() {
    return $this->valores();
    }
}