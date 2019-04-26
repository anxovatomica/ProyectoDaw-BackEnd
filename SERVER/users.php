
<?php header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    $alumnes= ["Oli"=>array("nom"=>"Oli","edat"=>31)];
    // Per capturar les dades del JSON del request HTTP:
    $jsonUsu = json_decode(file_get_contents("php://input"), false);
    $alumnes[$jsonUsu->nom] = $jsonUsu; //guardem alumne en el array
    echo json_encode($alumnes); //retorna tots els alumnes
