<?
// GET
$datos= file_get_contents("https://reqres.in/api/users/2");
$obj= json_decode($datos);

// POST
//Inicializar curl
$ch = curl_init();
//Url petición
curl_setopt($ch, CURLOPT_URL, "https://reqres.in/api/users");
//Indicamos que la respuesta se devuelva en la variable y no se mande al navegador
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
//El verbo será POST
curl_setopt($ch, CURLOPT_POST, 1);
//Los campos a enviar
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"name": "Ana", "job": "Developer"}');
$result = curl_exec($ch);
$obj= json_decode($result);

// PUT
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://reqres.in/api/users/2");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_PUT, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"name": "Ana", "job": "Developer"}');
$result = curl_exec($ch);
$obj= json_decode($result);

// DELETE
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://reqres.in/api/users/2");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"DELETE");
$result = curl_exec($ch);

$verbo = $_SERVER['REQUEST_METHOD'];
switch ($verbo) {
    case 'GET':
        // GET
        $datos= file_get_contents("https://reqres.in/api/users/2");
        $obj= json_decode($datos);
      break;
    case 'POST':
        // POST
        //Inicializar curl
        $ch = curl_init();
        //Url petición
        curl_setopt($ch, CURLOPT_URL, "https://reqres.in/api/users");
        //Indicamos que la respuesta se devuelva en la variable y no se mande al navegador
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        //El verbo será POST
        curl_setopt($ch, CURLOPT_POST, 1);
        //Los campos a enviar
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"name": "Ana", "job": "Developer"}');
        $result = curl_exec($ch);
        $obj= json_decode($result);
      break;
    case 'PUT':
        // PUT
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://reqres.in/api/users/2");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_PUT, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"name": "Ana", "job": "Developer"}');
        $result = curl_exec($ch);
        $obj= json_decode($result);
      break;
    case 'DELETE':
        // DELETE
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://reqres.in/api/users/2");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"DELETE");
        $result = curl_exec($ch);
      break;
    default:

      break;
}