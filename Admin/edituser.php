<?php
include('config.php');

$id = $_GET['id'];

if(isset($_POST['submit']))
{
	$password = $_POST['password'];
	$admin = $_POST['admin'];
	$param_password = password_hash($password, PASSWORD_DEFAULT);
	
	if(empty(trim($password)))
	{
		$update = "UPDATE users SET admin='$admin' WHERE id=$id";
	}
	else
	{
		$update = "UPDATE users SET password='$param_password',admin='$admin' WHERE id=$id";
	}

	if (mysqli_query($con, $update)) {
		header('location:updateusers.php');
	} else {
  		echo "Error updating record: " . mysqli_error($conn);
	}
}

?>