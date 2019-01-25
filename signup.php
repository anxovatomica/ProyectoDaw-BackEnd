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
                <button type="submit"><a href="index.php" class="btn btn-primary"> Submit</a></button>
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
                    // create user
                    newUser($name, $surname, $birthdate, $address, $email, $pass);
                }
                    if (!empty($id) ) {
                        // Delete user
                        $usuario=new User();
                        $usuario->load($id);
                        $usuario->delete();
                }
                // Load all users
                $user = new User();
                $users = $user -> loadAll();
                
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
            }
          
            ?>
        </div>
    </body>
</html>