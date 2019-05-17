<?php

session_start();
if(isset($_POST["lletra"]) && isset($_POST["paraula"])){
    $lletra = $_POST["lletra"];
    $paraula = $_POST['paraula'];
    if (strpos($paraula, $lletra) !== false) {
        $_SESSION["resp"] = "true";
        echo 'true';
    }else{
        $_SESSION["resp"] = "false";
        echo 'false';
    }   
    //echo $lletra ." - ". $paraula;
}
