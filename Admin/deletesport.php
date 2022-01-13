<?php

include('config.php');
$id = $_GET['id'];
$delete = "DELETE FROM studentsport WHERE cid = $id";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:updatesport.php');
}else{
	echo "Donot Delete";
}


?>