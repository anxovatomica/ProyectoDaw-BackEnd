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
                <h1>Log in users</h1>
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

                $usuario=new User();

                if (!empty($_POST['btnLogin'])) {
                    $username = trim($_POST['email']);
                    $password = trim($_POST['password']);
                 
                    if ($username == "") {
                        $login_error_message = 'Username field is required!';
                    } else if ($password == "") {
                        $login_error_message = 'Password field is required!';
                    } else {
                        $id = $usuario->Login($username, $password); // check user login
                        if($id > 0) {
                            session_start();
                            $_SESSION['id'] = $id; // Set Session
                            header("Location: home.php"); // Redirect user
                        }
                        else
                        {
                            $login_error_message = 'Invalid login details!';
                        }
                    }
                }
                // Code For LOGIN value="<?= $user['email']
                        ?>
                        <h4>Login</h4>
           
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control"/>
                </div>
                <div class="form-group">
                    <input type="submit" name="btnLogin" class="btn btn-primary" value="Login"/>
                </div>
            </form>
                        <?php
            
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>
        </div>
    </body>
</html>
