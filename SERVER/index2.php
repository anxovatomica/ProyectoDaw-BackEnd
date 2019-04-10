<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    
    include_once('user.php');
    include_once('tablaclass.php');
    include_once('webServices.php');
    

    $servername = "mysql-plugwalk.alwaysdata.net";
    $username = "plugwalk";
    $password = "Plugwalk123*";
    $dbname = "plugwalk_marcel";
    
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
            while($row = mysqli_fetch_assoc($result)){
                $emparray[] = $row;       //insertamos en el array $emparray todas las respuestas
            }
            $resposta= array("resposta"=> ($emparray)); //el array no retornamos como el parametro "resposta"
            
            
            
            break;
            
        default:
            //$resposta= '{"resposta":"'.$_SERVER['REQUEST_METHOD'].'"}';
            $resposta=array("resposta"=>$_SERVER['REQUEST_METHOD']);
    }
    
    
    echo json_encode($resposta);
    $conn->close();
