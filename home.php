<h1>WELCOME USER</h1>
<?php
session_start();
// check user login
if(empty($_SESSION['id']))
{
  //  header("Location: index.php");
}
 
// Database connection
include_once('user.php');
include_once('tablaclass.php');
            $server = "localhost";
            $user = "root";
            $pass = "";
            $db = "plugwalk";
            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
// Application library ( with DemoLib class )
$usuario = new User();
 
$user = $usuario->UserDetails($_SESSION['id']); // get user details
 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="well">
            <h2>
                Profile
            </h2>
            <h3>Hello <?php echo $user->name ?>,</h3>
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>
</body>
</html>
