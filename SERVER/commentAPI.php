<?php
    
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    
    include_once('tablaclass.php');
    require_once('controlToken.php');
    //include_once('webServices.php');
    
    $servername = "mysql-plugwalk.alwaysdata.net";
    $username = "plugwalk";
    $password = "Plugwalk123*";
    $dbname = "plugwalk_marcel";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
    /*SI NO HAY TOKEN, CREAMOS EL TOKEN CON LA INFO DEL USUARIO*/
    $data = file_get_contents('php://input'); //$data = {“nom”:”juan”,”pass”:”1234}
    echo $data;
    $comment = json_decode($data);
    
    
    $usu_id = $comment->idUser;
    //echo "Usu id: ".$usu_id;
    //CHECK QUE LES SIGUIN CORRECTES AMB LA BASE DE DADES
    //var_dump($usu_pass);
    $sql = "SELECT * FROM COMMENT WHERE idUser='".$usu_id."';";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            //     echo "Email: " . $row["email"]. " Password: " . $row["password"]. "<br>";
            //  $resposta = json_encode($row);
            //dades usuari correctes per fer el login
            //echo $row;
            
            $data = '{"idComment":"'.$row["idComment"].'","idUser":"'.$row["idUser"].'","idPost":"'.$row["idPost"].'","comment":"'.$row["comment"].'","date":"'.$row["date"].'",}';
            
            $token =jwtGetCodeJSON($data);
            
            $resposta= '{"token":"'.$token.'"}';
            break;
        }
        
    } else {
        $resposta= '{"resultado":"0 results SQL: '. $sql.'"}';
    }
    echo $resposta;
    $conn->close();
    
    
    
    
    
    
    
    
    
    
    
    
    
    //GENERA EL TOKEN NOMES SI SON CORRECTES
    $token =jwtGetCodeJSON( $data );
    //echo '{"token":"'.$token.'"}';
    

