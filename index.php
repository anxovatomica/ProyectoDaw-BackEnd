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
            <form method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input type="text" class="form-control" id="surname"  name="surname">
                </div>
                <div class="form-group">
                    <label for="birthdate">Birthdate:</label>
                    <input type="text" class="form-control" id="birthdate"  name="birthdate">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address"  name="address">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email">
                 </div>
                <div class="form-group">
                    <label for="pass">Password:</label>
                    <input type="text" class="form-control" id="pass"  name="pass">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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
                
                if (!empty($name)/* && !empty($surname) && !empty($birthdate) && !empty($address) && !empty($email) && !empty($pass)*/) {
                    newUser($name, $surname, $birthdate, $address, $email, $pass);
                }
                    if (!empty($id) ) {
                        echo $id;
                        $usuario=new User();
                        $usuario->load($id);
                        echo $usuario->id;
                        $usuario->delete();
                    /*$sql = "delete from users where id=$id";
                    if ($conn->exec($sql)) {
                        ?>
                        <div class="alert alert-success">
                            <strong>Correcto: </strong> User eliminado con id <?= $id ?>.
                        </div>
                        <?php
                    }*/
                }
                $sql = "select * from user";
                $res = $conn->query($sql);
                $users = $res->fetchAll();
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
                        foreach ($users as $user) {
                            ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['name'] ?></td>
                                <td><?= $user['surname'] ?></td>
                                <td><?= $user['birthdate'] ?></td>
                                <td><?= $user['address'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['password'] ?></td>
                                <td><a class="btn btn-primary " href="?id=<?= $user['id'] ?>">Borrar</a>
                                <a class="btn btn-primary " href="editar.php?id=<?= $user['id'] ?>" data-id="'.$user->delelete($user['id']).'">Editar</a></td>
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
            function newUser($name, $surname, $birthdate, $address, $email, $pass){
                $a = new User();
                $a->name = $name;
                $a->surname = $surname;
                $a->birthdate = $birthdate;
                $a->address = $address;
                $a->email = $email;
                $a->password = $pass;
                $a->save();
                //print_r($a);
            }
          
            ?>
        </div>
    </body>
</html>