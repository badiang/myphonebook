<?php

$username = $_POST['username'];

$password = $_POST['password'];

$gender = $_POST['gender'];

$email = $_POST['email'];

$phoneCode = $_POST['phoneCode'];

$phone = $_POST['phone'];

if (!empty($username) || !empty($password) || !empty($gender) || !empty($email) ||

!empty($phoneCode) || !empty($phone)) {

 $host = "localhost";

    $dbUsername = "root";

    $dbPassword = "";

    $dbname = "elective1";

    //create connection

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {

     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());

    } else {

     $SELECT = "SELECT email From register Where email = ? Limit 1";

     $INSERT = "INSERT INTO register ( username, password, gender, email, phoneCode, phone) VALUES ( ?, ?, ?, ?, ?, ?)";
     

     //Prepare statement

     $stmt = $conn->prepare($SELECT);

     $stmt->bind_param("s", $email);

     $stmt->execute();

     $stmt->bind_result($email);

     $stmt->store_result();

     $rnum = $stmt->num_rows;

     if ($rnum==0) {

      $stmt->close();

      $stmt = $conn->prepare($INSERT);

      $stmt->bind_param("ssssii", $username, md5($password), $gender, $email, $phoneCode, $phone);

      $stmt->execute();

      echo "New record inserted sucessfully";

     } else {

      echo "Someone already register using this email";

     }

     $stmt->close();

     $conn->close();

    }

} else {

 echo "All field are required";

 die();

}

?>

<!DOCTYPE html>
<html>
<head>
  <h1>Wel<span>come</span></h1>
  <link rel="stylesheet" href="insertstyle.css">
  <title></title>
</head>
<body>
  <div class="login-box">
  
<a class="btn" href="register.html">Register</a>
<a class="btn" href="login.php">Login</a>
  
</body>
</html>