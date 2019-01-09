<?php 
	include("connect.php"); 
	
	session_start();
	
	$username = $password = '';
	
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = md5($password);
		$login = "select * from register where username = '$username' AND password ='$password'";
		$result = mysqli_query($conn, $login);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		if($count== 1){
			$_SESSION['id'] = $row[0];
			$_SESSION['username'] = $row[1];
			header('location: contact.php');
		}else{
			echo "<script>alert('Invalid Username/Password');</script>";
		}


	}


?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="loginstyle.css">
	<title>Login</title>
</head>

<body>
<form method="post" action="">
<div class="login-box">
 <h1>Enter Account</h1>
<div class="textbox">
	<i class="fa fa-user" aria-hidden="true"></i>
Username : <input type= "text" name="username"><br><br>
</div>
<div class="textbox">
	<i class="fa fa-lock" aria-hidden="true"></i>
Password : <input type ="password" name="password"><br><br>
</div>
<input class="btn" name="login"  type="Submit" value="Submit">
<p>
	Doesn't have account? <a href="register.html">Sign in</a>
</p>


</form>
<body>
</html>

