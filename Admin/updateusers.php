<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// database connection
include('config.php');

$added = false;


?>







<!DOCTYPE html>
<html lang="en">

<head>
	<title>CRUD Operation utilisateur</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

	<div class="container">
		<nav class="modal-content">
			<a class="navbar-brand" href="index.php" style="font-size:30px;"><strong>Accueil</strong></a>
			

				
		</nav>
		<!-- adding alert notification  -->
		<?php
	if($added){
		echo "
			<div class='btn-success' style='padding: 15px; text-align:center;'>
				Data has been Successfully Added.
			</div><br>
		";
	}
?>


		<hr>
		<table class="table table-bordered table-striped table-hover" id="myTable">
			<thead>
				<tr>
				<th class="text-center" scope="col">User Id</th>
					<th class="text-center" scope="col">Username</th>
					<th class="text-center" scope="col">Cree le</th>
					<th class="text-center" scope="col">Type</th>
					<th class="text-center" scope="col">Modifier</th>
					<th class="text-center" scope="col">supprimer</th>
				</tr>
			</thead>
			<?php

        	$get_data = "SELECT * FROM users order by 1 desc";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['id'];
				$username = $row['username'];
				$created_at = $row['created_at'];
				$admin = $row['admin'];
				$admintxt = "Admin";
				if(!$admin) $admintxt = "Utilisateur";
        		echo "

				<tr>
				<td class='text-left'>$id</td>

				<td class='text-left'>$username</td>
				<td class='text-left'>$created_at</td>
				<td class='text-center'>$admintxt</td>

				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edituser$id' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>
					</span>
				</td>
				<td class='text-center'>
					<span>
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>
			</tr>
        	";
        	}

        	?>



		</table>
	</div>


	<!------DELETE modal---->
	<!-- Modal -->
	<?php

$get_data = "SELECT * FROM users";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	echo "

<div id='$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>
    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title text-center'>ETES VOUS SUR?</h4>
      </div>
      <div class='modal-body'>
        <a href='deleteUser.php?id=$id' class='btn btn-danger' style='margin-left:250px'>Delete</a>
      </div>
    </div>
  </div>
</div>
	";
}

?>

	<!----edit Data--->

	<?php

$get_data = "SELECT * FROM users";
$run_data = mysqli_query($con,$get_data);


while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$username = $row['username'];
	$password = $row['password'];
	$admin = $row['admin'];
	$admintxt= "Admin";
	if($admin == 0)
		$admintxt= "Utilisateur";
	echo "
	
	<div id='edituser$id' class='modal fade' role='dialog'>
	<div class='modal-dialog'>
  
	  <!-- Modal content-->
	  <div class='modal-content'>
		<div class='modal-header'>
			   <button type='button' class='close' data-dismiss='modal'>&times;</button>
			   <h4 class='modal-title text-center'>$username</h4> 
		</div>
  
					<div class='modal-body'>
						<form action='edituser.php?id=$id' method='post' enctype='multipart/form-data'>
		

						<div class='form-group col-md-12'>
							<label for='inputAddress'>Mot de passe </label>
							<input type='text' class='form-control' name='password' value=''
								placeholder='Entrer mot de passe'>
						</div>

						
							<div class='form-group col-md-12'>
								<input type='submit' name='submit' class='btn btn-info btn-large' value='submit'>
							</div>
						</form>
					</div>
				<div class='modal-footer'>
			</div>
		</div>
	</div>
</div>
";

}
?>
	

</body>

</html>