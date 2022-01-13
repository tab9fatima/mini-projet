<?php

include('config.php');
$id = $_GET['id'];
$delete = "DELETE FROM studentnationality WHERE cid = $id";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:updatenationaliti.php');
}else{
	echo "Donot Delete";
}


?>