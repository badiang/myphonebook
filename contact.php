<?php
	// connect  to the database

	session_start();
	$user_id = $_SESSION['id'];
$db=mysqli_connect('localhost', 'root', '', 'elective1');
if(isset($_POST['submit'])){
	$contact=$_POST['task'];
	$number = $_POST['number'];
	
	mysqli_query($db,"	INSERT INTO `contact` (`id`, `Task`, `Number`, `user_id`) VALUES (NULL, '$contact', '$number', '$user_id');");
	echo "<script>alert('Data Inserted!!!')</script>";
	 
}


// delete contact
if (isset($_GET['del_contact'])){
$id = $_GET['del_contact'];
mysqli_query($db, "DELETE FROM contact WHERE id=$id");
header('location: contact.php');
}

//edit contact
if (isset($_POST['update'])){
	$contact=$_POST['task'];
	$number = $_POST['number'];
	$id = $_POST['id'];
	$update =  "UPDATE `contact` SET `Task`='$contact',`Number`='$number' WHERE id=".$id;
	mysqli_query($db,$update);
	if (mysqli_query($db, $update)) {
		echo"
			<script>
				var msg=confirm('New Record Updated!!!');
				if(msg == true || msg==false){
					location.href='contact.php';
				}
			</script>
		";
	} else {
			echo "Error: " . $update . "<br>" . mysqli_error($db);
	}
	
}


$contact=mysqli_query($db, "SELECT * FROM contact");

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="contactstyle.css">
</head>
<body>
<h1 id="welcome">Welcome <?php echo $_SESSION['username']; ?>  </h1>
<div class="heading">
<h2>Myphonebook</h2>
<a class="btn" href="logout.php">Logout</a>
</div>

<?php
 	if(isset($_GET['edit_contact'])){
	$id=$_GET['edit_contact'];		 

	$get_contact = mysqli_query($db, "select * from contact where id = '$id'");

	$row = mysqli_fetch_array($get_contact);

		 
?>
	<form method="POST" action="contact.php?edit_contact=<?php echo $_GET['edit_contact'] ?>">
		<?php if (isset($errors)){ ?>
		<p><?php echo $errors; ?></p>
		<?php } ?>
	<input type="hidden" value="<?php echo $id; ?>" name="id">
	<input type="text" placeholder="Name" value="<?php echo $row[1] ?>" name="task" class="task_input" required autofocus>
	<input type="text" placeholder="Number" value="<?php echo $row[2] ?>" name="number" class="task_input" required>
	<button type="submit" class="add_btn" name="update">update</button>

	</form>
 <?php
 } else{?>
	<form method="POST" action="contact.php">
	<?php if (isset($errors)){ ?>
<p><?php echo $errors; ?></p>
<?php } ?>
<input type="text" placeholder="Name" name="task" class="task_input" required autofocus>
<input type="text" placeholder="Number" name="number" class="task_input" required>
<button type="submit" class="add_btn" name="submit">Save</button>

</form>

 <?php
 }
?>



<table>
<thead>
	<tr>
		<th>N</th>
		<th>Name</th>
		<th>Number
		</th>
		<th>Action</th>
</tr>
</thead>
<tbody>
<?php 

$contact = mysqli_query($db, "SELECT * FROM contact where user_id = '$user_id'");

$i = 1; while ($row=mysqli_fetch_array($contact)) { ?>
	<tr>
<td><?php echo $i; ?></td>
<td ><?php echo $row['Task'];?></td>

<td ><?php echo $row['Number'];?></td>
<td class="delete">
<a href="contact.php?del_contact=<?php echo $row['id']; ?>">Delete</a>
<td class="update">
<a href="contact.php?edit_contact=<?php echo $row['id']; ?>">Edit</a>

</td>
</tr
<?php $i++; } ?>

</tbody>
</table>

</body>

</html>

