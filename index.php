<!DOCTYPE html>

<html><head>
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <title>CRUD USERS</title>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>USERS CRUD</h1>
            </div>
            <a href="signup.php" class="btn btn-primary">Sign up</a>
            <a href="login.php" class="btn btn-primary">Log in</a>
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
                $controller= filter_input(INPUT_GET, "user");
                $id = filter_input(INPUT_GET, "id");
                $objeto = new User();
                $verb=$_SERVER['REQUEST_METHOD'];
                $http = new HTTP();
                if (empty($controller) || !file_exists($controller.".php")){
                    $http=new HTTP();
                    //$http->setHttpHeaders(400,new Response("Bad request"));
                    //die();
                }
                if ($verb == "GET") {
                    echo "<br>";
                    if (empty($id)) {
                    $datos = $objeto->loadAll();
                    $http->setHttpHeaders(200, new Response("Lista $controller",$datos));
                    } else {
                    $objeto->load($id);
                    $http->setHttpHeaders(200, new Response("Lista $controller",$objeto->serialize()));
                    }
                }
               /*
                    if (!empty($id) ) {
                        // Delete user
                        $usuario = new User();
                        $usuario->load($id);
                        $usuario->delete();
                } */
                // Load all users
                // $user = new User();
                $datos = $objeto -> loadAll();
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Birthdate</th>
                            <th>Address</th>
                            <th>Surname</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($datos as $objeto) {
                            ?>
                            <tr>
                                <td><?= $objeto['id'] ?></td>
                                <td><?= $objeto['name'] ?></td>
                                <td><?= $objeto['surname'] ?></td>
                                <td><?= $objeto['birthdate'] ?></td>
                                <td><?= $objeto['address'] ?></td>
                                <td><?= $objeto['email'] ?></td>
                                <td><?= $objeto['password'] ?></td>
                                <td><a class="btn btn-primary " href="?id=<?= $objeto['id'] ?>">Borrar</a>
                                <a class="btn btn-primary " href="editar.php?id=<?= $objeto['id'] ?>" data-id="'.$user->delete($user['id']).'">Editar</a></td>
                                <!--<a href="borrarProducto.php?id={$producto->id}" class="eliminar" data-id="'.$obj_kart->del_prod($producto->id).'">Eliminar</a>-->
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
          
            ?>
        </div>
    </body>
</html>