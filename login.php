<div id="login">
<h3>Login</h3>
<form method="post" action="" name="login">
<label>Email</label>
<input type="text" name="usernameEmail" autocomplete="off" />
<label>Password</label>
<input type="password" name="password" autocomplete="off"/>
<div class="errorMsg"><?php echo "Error"; ?></div>
<input type="submit" class="button" name="loginSubmit" value="Login">
</form>
</div>
<?php
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
?>