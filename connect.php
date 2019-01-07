<?php
$conn = mysqli_connect('localhost','root','','elective1');

if($conn == false){
	echo "Error : ". $conn . mysqli_connect_errno();
}

?>

