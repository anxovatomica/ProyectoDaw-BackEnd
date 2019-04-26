<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    
    include_once('tablaclass.php');
    include_once('user.php');
    //include_once('webServices.php');
    
    $servername = "mysql-plugwalk.alwaysdata.net";
    $username = "plugwalk";
    $password = "Plugwalk123*";
    $dbname = "plugwalk_marcel";
    
    try {
        //$conn = new PDO("mysql:host=mysql-plugwalk.alwaysdata.net;dbname=plugwalk_marcel", $username, $password);
        //$conn ->  setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $controller = filter_input(INPUT_GET, "user");
        $id = filter_input(INPUT_GET, "idUser");
        $objeto = new User();
        $verb = $_SERVER['REQUEST_METHOD'];
        $http = new HTTP();
        if (empty($controller) ||  !file_exists($controller . ".php")) {
            $http = new HTTP();
        }
        switch ($verb) {
            case 'GET':
                if (empty($id)) {
                    $datos = $objeto -> loadAll();
                    $http -> setHttpHeaders(200, new Response($datos));
                }else {
                    $objeto -> load($id);
                    $http -> setHttpHeaders(200, new Response($objeto -> serialize()));
                }
                
                $datos = $objeto -> loadAll();
                
                break;
            case 'POST':
             //   echo "DENTRO POST";
                $raw=file_get_contents("php://input");
                $datos=json_decode($raw);
                foreach($datos as $c=>$v){
                    $objeto->$c=$v;
                }
                $objeto->save();
                break;
            default:
                echo ' SORRY BRO :( ';
                break;
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        
    }
    //echo json_encode($resposta);
    
    
    //$resposta=array("resposta"=>$_SERVER['REQUEST_METHOD']);
    
    

    /*
     switch ($_SERVER['REQUEST_METHOD']) { //obtenemos si se ha realizado un GET, POST, PUT o DELETE
     case "POST": //actualizar o crear un producto
     
     $jsonProducto = file_get_contents("php://input");
     echo $jsonProducto;
     
     break;
     
     case "GET":
     $resposta=array("resposta"=>"Pedro Picapiedra");
     echo json_encode($resposta);
     break;
     default:
     //$resposta= '{"resposta":"'.$_SERVER['REQUEST_METHOD'].'"}';
     $resposta=array("resposta"=>$_SERVER['REQUEST_METHOD']);
     echo json_encode($resposta);
     echo 'sorry bro :(';
     }
        
    /*
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        include_once('user.php');
        include_once('tablaclass.php');
        include_once('webServices.php');
  
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_STRING);
        $birthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
        
        $servername = "mysql-plugwalk.alwaysdata.net";
        $username = "plugwalk";
        $password = "Plugwalk123*";
        $dbname = "plugwalk_marcel";
    
    
    
        try {
            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $controller = filter_input(INPUT_GET, "user");
            $id = filter_input(INPUT_GET, "id");
            $objeto = new User();
            $verb = $_SERVER['REQUEST_METHOD'];
            $http = new HTTP();
            if (empty($controller) ||  !file_exists($controller . ".php")) {
                $http = new HTTP();
            }
            if ($verb == "GET") {
                echo "<br>";
                if (empty($id)) {
                    $datos = $objeto -> loadAll();
                    $http -> setHttpHeaders(200, new Response("LIST: $controller", $datos));
                }else {
                    $objeto -> load($id);
                    $objeto -> delete();
                    $http -> setHttpHeaders(200, new Response("USER: $controller", $objeto -> serialize()));
                }
            }
            $datos = $objeto -> loadAll();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    

                

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");   
    $servername = "mysql-plugwalk.alwaysdata.net";
    
    $username = "plugwalk";
    $password = "Plugwalk123*";
    $dbname = "plugwalk_marcel";
switch ($_SERVER['REQUEST_METHOD']) { //obtenemos si se ha realizado un GET, POST, PUT o DELETE
      case "POST": //actualizar o crear un producto
        
        $jsonProducto = file_get_contents("php://input");
        echo $jsonProducto;
        
    break;
    
      case "GET":
            $resposta=array("resposta"=>"Pedro Picapiedra");
            echo json_encode($resposta);
          break;
    default:
        //$resposta= '{"resposta":"'.$_SERVER['REQUEST_METHOD'].'"}';
        $resposta=array("resposta"=>$_SERVER['REQUEST_METHOD']);
         echo json_encode($resposta);
         echo 'sorry bro :(';
}
 


/* conexió amb la base de dades */
/*
//?u=id4881760_r007&p=12345&n=id4881760_nativescript_productes
$servername = "localhost";
$username = "id4881760_r007";
$password = "12345";
$dbname = "id4881760_nativescript_productes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//las consultas las realizaremos con una URI del estilo:  apiProductos.php/producto/0

switch ($_SERVER['REQUEST_METHOD']) { //obtenemos si se ha realizado un GET, POST, PUT o DELETE
 
      case "POST": //actualizar o crear un producto
    
       $paramsRuta = explode("producto/", $_SERVER['REQUEST_URI']);  // extraemos el id (0)
        // Para capturar los datos entrada JSON que viene en el request HTTP:
        
        $jsonProducto = json_decode(file_get_contents("php://input"), false);
        $nom=$jsonProducto->nom;
        $preu=$jsonProducto->preu;
        $descr =$jsonProducto->descripcio;

        switch(isset($paramsRuta[1])){  //Si se indica ID haremos un UPDATE
            case true:
                $id=$paramsRuta[1];
                $sql = "UPDATE producte SET nom='$nom' , preu='$preu' , descripcio='$descr'   WHERE id=$id";
                
                if($conn->query($sql)){ break; } 
                //si no se ha podido hacer el updat correctamente, hacemos un insert
                
            default: //si no se indica ID haremos un insert
                $sql ="INSERT INTO producte (nom,preu,descripcio) VALUES ('$nom','$preu','$descr')";
                
                $conn->query($sql);
        }
        //por ultimo retorna todos los productos
        $sql = "SELECT * FROM producte";  
        $result = $conn->query($sql);
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray[] = $row;
        }
        $resposta= array("resposta"=> ($emparray));
        
    break;
    case "DELETE":  //000webhostapp no permet métodes DELETE :((, utilizaremos el GET
        
        //borramos un elmento según su ID
        $paramsRuta = explode("producto/", $_SERVER['REQUEST_URI']);  // extraemos el id (0)
    
        if(isset($paramsRuta[1])){  //si se indica ID, vamos a intentar borrar el producto
                $id = explode("producto/", $_SERVER['REQUEST_URI'])[1];
                $sql = "DELETE FROM producte  WHERE id=$id";
                $conn->query($sql);
        }
        //RETORNA TOTS ELS PRODUCTES
        $sql = "SELECT * FROM producte";  
        $result = $conn->query($sql);
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
                $emparray[] = $row;
        }
        $resposta= array("resposta"=> ($emparray));
        
        break;
       
    case "GET":  //con GET podemos obtener uno o trodos los productos según se indique id o no
    //INICI DEL DELETE
        //000webhostapp no permet métodes DELETE :((, utilizaremos un GET con el parametro "producto_delete"
        //dividimos la uri en un array de 2 elementos. 1º con la URI hasta producto/ , 2º con el resto ( id producto)
        $paramsRuta = explode("producto_delete/", $_SERVER['REQUEST_URI']);  
        if(isset($paramsRuta) 
        && isset($paramsRuta[1]) 
        && $paramsRuta[1]!=""){ 
             $id = $paramsRuta[1];
             $sql = "DELETE FROM producte  WHERE id=$id";
             $conn->query($sql);
        }
    //FI DEL DELETE
    
        //dividimos la uri en un array de 2 elementos. 1º con la URI hasta producto/ , 2º con el resto ( id producto)
        $paramsRuta = explode("producto/", $_SERVER['REQUEST_URI']);  
    
        if(isset($paramsRuta) && isset($paramsRuta[1]) && $paramsRuta[1]!=""){  //si existe id del producto
           
        //    $id = explode("producto/", $_SERVER['REQUEST_URI'])[1];
            $id= $paramsRuta[1];
          
              
            $sql="SELECT * FROM producte where id='$id'";   //creamos la query para obtener la info del producto
            
        }else{ //si no se ha indicado id de producto
            $sql = "SELECT * FROM producte";       //obtnemos el listado de todos los produtos 
          
        }      
        //a continuacion ejecutamos la query 
        $result = $conn->query($sql);
        $emparray = array();
        while($row =mysqli_fetch_assoc($result)){   
            $emparray[] = $row;       //insertamos en el array $emparray todas las respuestas
        } 
        $resposta= array("resposta"=> ($emparray)); //el array no retornamos como el parametro "resposta"
        
        
        
     break;
    
    default:
        //$resposta= '{"resposta":"'.$_SERVER['REQUEST_METHOD'].'"}';
        $resposta=array("resposta"=>$_SERVER['REQUEST_METHOD']);
}

*/
