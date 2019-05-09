<?php
    //header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
     
    include_once('tablaclass.php');
    include_once('post.php');
    //include_once('webServices.php');
    
    $servername = "mysql-plugwalk.alwaysdata.net";
    $username = "plugwalk";
    $password = "Plugwalk123*";
    $dbname = "plugwalk_marcel";
    
    try {
        //$conn = new PDO("mysql:host=mysql-plugwalk.alwaysdata.net;dbname=plugwalk_marcel", $username, $password);
        //$conn ->  setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $controller = filter_input(INPUT_GET, "post");
        $id = filter_input(INPUT_GET, "idPOST");
        $objeto = new Post();
        $verb = $_SERVER['REQUEST_METHOD'];
        $http = new HTTP();
        if (empty($controller) ||  !file_exists($controller . ".php")) {
            $http = new HTTP();
        }
        switch ($verb) {
            case 'GET':
                if (empty($id)) {
                    $datos = $objeto -> loadAll();
                    $http -> setHttpHeaders(200, new Response("LIST: $controller", $datos));
                }else {
                    $objeto -> load($id);
                    $http -> setHttpHeaders(200, new Response("USER: $controller", $objeto -> serialize()));
                }
                
                $datos = $objeto -> loadAll();
                
                break;
            case 'POST':
           //     echo "DENTRO POST";
                $raw=file_get_contents("php://input");
                $datos=json_decode($raw);
               // echo json_decode($datos);
                echo $raw;
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

    
