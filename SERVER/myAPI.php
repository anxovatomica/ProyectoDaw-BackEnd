<?php
    header("Access-Control-Allow-Origin: *");
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
    
    // var_dump( $usuari->name );
    $usu_name = $usuari->name ;
    $usu_pass = $usuari->password;
    //CHECK QUE LES SIGUIN CORRECTES AMB LA BASE DE DADES
    
    $sql = "SELECT email, password FROM USER WHERE email='".$usu_name."' AND password='".$usu_pass."';";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Email: " . $row["email"]. " Name: " . $row["name"]. "<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    
    
    
    
    
    
    /*SI NO HAY TOKEN, CREAMOS EL TOKEN CON LA INFO DEL USUARIO*/
    $data = file_get_contents('php://input'); //$data = {“nom”:”juan”,”pass”:”1234}
    $usuari = json_decode($data);
    
    
    
    
    
    
    //GENERA EL TOKEN NOMES SI SON CORRECTES
    $token =jwtGetCodeJSON( $data );
    echo '{"token":"'.$token.'"}';
    
