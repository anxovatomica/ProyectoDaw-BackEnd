<!DOCTYPE html>

<html><head>
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <title>Mantenimiento users</title>
    </head>
    <body> <div class="container">
            <div class="jumbotron">
                <h1>Editar users</h1>
            </div>
            <?php
            include_once('user.php');
            include_once('tablaclass.php');

            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
            $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_STRING);
            $birthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_STRING);
            $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
            $pass = filter_input(INPUT_POST, "pass", FILTER_SANITIZE_STRING);
            $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

            $server = "localhost";
            $user = "root";
            $pass = "";
            $db = "plugwalk";

            try {

                $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $objeto = new User();
                $controller = filter_input(INPUT_GET, "user");
                $id = filter_input(INPUT_GET, "id");
                
                $verb = $_SERVER['REQUEST_METHOD'];
                $http = new HTTP();
                if (empty($controller) || !file_exists($controller.".php")){
                $http=new HTTP();
                }
                if ($verb == "POST") {
                    $raw = file_get_contents("http://input");
                    $datos = json_decode($raw);
                    foreach($datos as $c=>$v){
                        $objeto->$c=$v;
                    }
                        $objeto->save();
                    }
                /* 
                if (!empty($name) && !empty($email) && !empty($id)) {
                    $usuario = new User();
                    $usuario -> load($id);
                    $usuario -> updateUser($id,['name'=>$name,'surname'=>$surname, 'birthdate'=>$birthdate, 'address'=>$address, 'email'=>$email, 'password'=>$pass]);
                }*/

                if (!empty($id)) {

                // Load user
                $users = new User();
                $user = $users -> load2($id);
                $users -> updateUser($id,['name'=>$name,'surname'=>$surname, 'birthdate'=>$birthdate, 'address'=>$address, 'email'=>$email, 'password'=>$pass]);
                    /* $sql = "select * from user where id=$id";
                    $res = $conn->query($sql);
                    $user = $res->fetch(); */
                    if (!empty($user)) {
                        ?>
                        <form method="POST">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $user['id'] ?>">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="surname">Surname:</label>
                                <input type="text" class="form-control" id="surname"  name="surname" value="<?= $user['surname'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="birthdate">birthdate:</label>
                                <input type="text" class="form-control" id="birthdate"  name="birthdate" value="<?= $user['birthdate'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="address">address:</label>
                                <input type="text" class="form-control" id="address"  name="address" value="<?= $user['address'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email"  name="email" value="<?= $user['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">password:</label>
                                <input type="text" class="form-control" id="password"  name="password" value="<?= $user['password'] ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <a href="index.php" class="btn btn-primary">Vuelve</a>

                        </form>
                        <?php
                    } else {
                        ?><p>Usuario desconocido :(</p>
                        <?php
                    }
                } else {
                    ?><p>Falta el id</p>
                    <?php
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>
        </div>
    </body>
</html>
