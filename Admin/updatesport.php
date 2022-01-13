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
$notadd = false;
$isempty = false;
$indb = false;


//Add  new student code 

if(isset($_POST['submit'])){

	$u_sport = $_POST['u_sport'];

	if(empty(trim($_POST["u_sport"]))){
		$isempty = true;
    } else{
        // Prepare a select statement
        $sql = "SELECT cid FROM studentsport WHERE cname = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){

            mysqli_stmt_bind_param($stmt,'s', $param_username);
            
            $param_username = trim($_POST["u_sport"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
					$indb = true;
                } else{
                    $u_sport = trim($_POST["u_sport"]);
					$insert_data = "INSERT INTO studentsport(cname) VALUES ('$u_sport')";
 				 	$run_data = mysqli_query($con,$insert_data);
					if($run_data){
						$added = true;
					}else{
						$notadd = true;
					}
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
	}
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>Crud Operation Activites sportives</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
	.marginauto {
    margin: 10px auto 20px;
    display: block;
}
</style>
</head>

<body>

	<div class="container">
		<nav class="modal-content">
			<a class="navbar-brand" href="index.php" style="font-size:30px;"><strong>Accueil</strong></a>
			<ul class="navbar-brand mr-auto">
		
		</nav>
		

		<!-- adding alert notification  -->
		<?php
	if($added){
		echo "
			<div class='btn-success' style='padding: 15px; text-align:center;'>
				succe d'ajout
			</div><br>
		";
	}
	else if($notadd) {
		echo "
			<div class='btn-danger' style='padding: 15px; text-align:center;'>
				Data has not been added.
			</div><br>
		";
	}
	else if($indb) {
		echo "
			<div class='btn-info' style='padding: 15px; text-align:center;'>
				Y'a un champ comme ca.
			</div><br>
		";
	}
	else if($isempty) {
		echo "
			<div class='btn-warning' style='padding: 15px; text-align:center;'>
				Ajouter un nom real .
			</div><br>
		";
	}
?>


		<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">
			<i class="fa fa-plus"></i> Ajouter sport
		</button>
		<hr>
		<table class="table table-bordered table-striped table-hover" id="myTable">
			<thead>
				<tr>
				<th class="text-center" scope="col">Sport Id</th>
					<th class="text-center" scope="col">Nom</th>
				
					<th class="text-center" scope="col">Edit</th>
					<th class="text-center" scope="col">Delete</th>
				</tr>
			</thead>
			<?php

        	$get_data = "SELECT * FROM studentsport order by 1 asc";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['cid'];
				$name = $row['cname'];
        		echo "

				<tr>
				<td class='text-left'>$id</td>
				<td class='text-left'>$name</td>
				
			
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#editsport$id' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>
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


	<!---Add in modal---->

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">

				</div>
				<div class="modal-body">
					<form method="POST" enctype="multipart/form-data">

						<div class="form-group col-md-12">
							<label for="inputAddress">Le nom du sport</label>
							<input type="text" class="form-control" name="u_sport" placeholder="Entrer le nom">
						</div>

						<div class="form-group col-md-6">
							<input type="submit" name="submit" class="btn btn-info btn-large" value="Submit">
						</div>

					</form>
				</div>
				<div class="modal-footer">
				</div>
			</div>

		</div>
	</div>



	<!------DELETE modal---->
	<!-- Modal -->
	<?php

$get_data = "SELECT * FROM studentsport";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['cid'];
	echo "

<div id='$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>
    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title text-center'>ETES VOUS SUR??</h4>
      </div>
      <div class='modal-body'>
        <a href='deletesport.php?id=$id' class='btn btn-danger' style='margin-left:250px'>Delete</a>
      </div>
    </div>
  </div>
</div>
	";
}

?>



	<?php

$get_data = "SELECT * FROM studentsport";
$run_data = mysqli_query($con,$get_data);


while($row = mysqli_fetch_array($run_data))
{
	$id = $row['cid'];
	
	$u_sport = $row['cname'];

	echo "
	
	<div id='editsport$id' class='modal fade' role='dialog'>
	<div class='modal-dialog'>
  
	  <!-- Modal content-->
	  <div class='modal-content'>
		<div class='modal-header'>
			   <button type='button' class='close' data-dismiss='modal'>&times;</button>
			   <h4 class='modal-title text-center'>$u_sport</h4> 
		</div>
  
					<div class='modal-body'>
						<form action='editsport.php?id=$id' method='post' enctype='multipart/form-data'>
		

						<div class='form-group col-md-12'>
							<label for='inputAddress'>Changer le nom de '$u_sport' à :</label>
							<input type='text' class='form-control' name='u_sport' value='$u_sport'
								placeholder='Entrer le nouveau nom'>
						</div>
							<div class='form-group col-md-12'>
								<input type='submit' name='submit' class='btn btn-info btn-large' value='submit'>
								<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
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
	<!-- <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#myTable').DataTable();
		});
	</script> -->

</body>

</html>