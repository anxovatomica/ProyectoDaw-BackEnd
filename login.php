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
                if (!empty($_POST['loginSubmit'])) 
{
$usernameEmail=$_POST['usernameEmail'];
$password=$_POST['password'];
if(strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 )
{
$uid=$userClass->userLogin($usernameEmail,$password);
if($uid)
{
$url=BASE_URL.'home.php';
header("Location: $url"); // Page redirecting to home.php 
}
else
{
$errorMsgLogin="Please check login details.";
}
}
}
                // Code For LOGIN
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email"  name="email" value="<?= $user['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="text" class="form-control" id="password"  name="password" value="<?= $user['password'] ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <a href="index.php" class="btn btn-primary">Vuelve</a>
                        </form>
                        <?php
            
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>
        </div>
    </body>
</html>