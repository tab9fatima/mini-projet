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


//Add  new student code 

if(isset($_POST['submit'])){
	$u_order = $_POST['u_order'];
	$u_save = $_POST['u_save'];
	$u_nationaliti = $_POST['u_nationaliti'];
	$u_adr = $_POST['u_adr'];
	$u_ville = $_POST['u_ville'];
	$u_pays = $_POST['u_pays'];
	$u_email = $_POST['u_email'];
	$u_f_name = $_POST['u_f_name'];
	$u_l_name = $_POST['u_l_name'];
	$u_state = $_POST['u_state'];
	$u_relegion = $_POST['u_relegion'];
	$u_blode = $_POST['u_blode'];
	$u_tabac = $_POST['u_tabac'];
	$u_birthday = $_POST['u_birthday'];
	$u_birthdayAdr = $_POST['u_birthdayAdr'];
	$u_birthdayPay = $_POST['u_birthdayPay'];
	$u_proffesion = $_POST['u_proffesion'];
	$u_proffesionAdr = $_POST['u_proffesionAdr'];
	$u_proffesionVille = $_POST['u_proffesionVille'];
	$u_phone = $_POST['u_phone'];
	$u_arts = $_POST['u_arts'];
	$u_sport = $_POST['u_sport'];
	$u_family = $_POST['u_family'];


	//image upload

	$msgs = "";
	$u_drapeau = $_FILES['u_drapeau']['name'];
	$targets = "admin/upload_images/".basename($u_drapeau);

	if (move_uploaded_file($_FILES['u_drapeau']['tmp_name'], $targets)) {
  		$msgs = "Image uploaded successfully";
  	}else{
  		$msgs = "Failed to upload image";
  	}

	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "admin/upload_images/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

	$vid = "";
	$video = $_FILES['video']['name'];
	$targetso = "admin/upload_images/".basename($video);

	if (move_uploaded_file($_FILES['video']['tmp_name'], $targetso)) {
  		$vid = "Image uploaded successfully";
  	}else{
  		$vid = "Failed to upload image";
  	}

	$ch = implode("|",$u_arts);
	$insert_data = "INSERT INTO student_data(u_order, u_save, u_nationaliti,u_drapeau, u_adr, u_ville, u_pays, u_email, u_f_name, u_l_name, u_state, u_relegion, u_blode, u_tabac, u_birthday, u_birthdayAdr, u_birthdayPay, u_proffesion, u_proffesionAdr, u_proffesionVille, u_phone, u_arts, u_sport, u_family, image,video, uploaded) VALUES ('$u_order', '$u_save', '$u_nationaliti','$u_drapeau', '$u_adr', '$u_ville', '$u_pays', '$u_email', '$u_f_name', '$u_l_name', '$u_state', '$u_relegion', '$u_blode', '$u_tabac', '$u_birthday', '$u_birthdayAdr', '$u_birthdayPay', '$u_proffesion', '$u_proffesionAdr', '$u_proffesionVille', '$u_phone', '$ch', '$u_sport','$u_family','$image','$video', NOW())";
  	$run_data = mysqli_query($con,$insert_data);

  	if($run_data){
		  $added = true;
  	}else{
  		echo "Data not insert";
  	}

}

?>







<!DOCTYPE html>
<html lang="en">

<head>
	<title>Student Crud Operation</title>
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
			<a class="navbar-brand" href="#" style="font-size:20px;"><strong>Espace utilisateur</strong></a>
			<hr>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<form class="modal-body" style="text-align:right">
					<a href="Welcome.php" class="btn btn-warning my-2 my-sm-0" type="submit">Profile</a>
					<hr>
					<a href="statistique.php" class="btn btn-info my-2 my-sm-0" type="submit">Statistique</a>
<hr>
					<a href="Logout.php" class="btn btn-danger my-2 my-sm-0" type="submit">Deconnexion</a>
				</form>
			</div>
		</nav>
		<hr>

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


		<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">
			<i class="fa fa-plus"></i> Ajouter 
		</button>
		<hr>
		<table class="table table-bordered table-striped table-hover" id="myTable">
			<thead>
				<tr>
				<th class="text-center" scope="col">Personnalité Id</th>

					<th class="text-center" scope="col">Nom</th>
				
					<th class="text-center" scope="col">Voir</th>
				</tr>
			</thead>
			<?php

        	$get_data = "SELECT * FROM student_data order by 1 desc";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['id'];
				$u_relegion = $row['u_relegion'];
				$u_f_name = $row['u_f_name'];
				$u_l_name = $row['u_l_name'];
				$u_phone = $row['u_phone'];
				$u_family = $row['u_family'];
				$u_tabac = $row['u_tabac'];
        		$image = $row['image'];
        		echo "

				<tr>
				<td class='text-left'>$id</td>

				<td class='text-left'>$u_f_name   $u_l_name</td>
			
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view$id' title='Prfile'><i class='fa fa-address-card-o' aria-hidden='true'></i></a>
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
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					

				</div>
				<div class="modal-body">
					<form method="POST" enctype="multipart/form-data">

						<!-- This is test for New Card Activate Form  -->
						<!-- This is Address with email id  -->
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputEmail4">Order Id</label>
								<input type="text" class="form-control" name="u_order"
									placeholder="Enter 12-digit order Id." maxlength="12" required>
							</div>
							<div class="form-group col-md-6">
								<label for="inputPassword4">Date Enregistrement</label>
								<input type="date" class="form-control" name="u_save" placeholder="Date Enregistrement">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label for="inputState">Pays Nationalité</label>
							<select id="inputState" name="u_nationaliti" class="form-control">
								<option hidden value="default">Select option</option>
								<?php
								$get_data = "SELECT * FROM studentnationality";
								$run_data = mysqli_query($con,$get_data);
								while($row = mysqli_fetch_array($run_data))
								{
									$id = $row['cid'];
									$name = $row['cname2'];
									echo "<option value='$id'>$name</option>";
								}
							?>
							</select>
						</div>

						<div class="form-group col-md-6">
							<label>Drapeau</label>
							<input type="file" name="u_drapeau" class="form-control">
						</div>

						<div class="form-group col-md-12">
							<label for="family">Adresse</label>
							<textarea style='resize: none' class="form-control" name="u_adr" rows="3"></textarea>
						</div>

						<div class="form-group col-md-6">
							<label for="inputAddress">Ville</label>
							<input type="text" class="form-control" name="u_ville" placeholder="Entrer la ville">
						</div>

						<div class="form-group col-md-6">
							<label for="inputAddress">Pays</label>
							<input type="text" class="form-control" name="u_pays" placeholder="Entrer le pay">
						</div>

						<div class="form-group col-md-12">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="u_email" placeholder="Entrer Email">
						</div>


						<div class="form-group col-md-6">
							<label for="firstname">Nom</label>
							<input type="text" class="form-control" name="u_f_name" placeholder="Entrez votre prénom">
						</div>
						<div class="form-group col-md-6">
							<label for="lastname">Prénom</label>
							<input type="text" class="form-control" name="u_l_name"
								placeholder="Entrer le nom de famille">
						</div>

						<div class="form-group col-md-6">
							<label for="inputState">Statut</label>
							<select id="inputState" name="u_state" class="form-control">
								<option hidden value="default">Select option</option>
								<option value="Marié">Marié</option>
								<option value="Célibataire">Célibataire</option>
								<option value="Veuf">Veuf</option>
								<option value="Divorcé">Divorcé</option>
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="inputState">Religion</label>
							<select id="inputState" name="u_relegion" class="form-control">
								<option hidden value="default">Select option</option>
								<option value="Musulmane">Musulmane</option>
								<option value="Chrétienne">Chrétienne</option>
								<option value="Juive">Juive</option>
								<option value="Autres">Autres</option>
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="inputState">Groupe Sanguin</label>
							<input type="text" class="form-control" name="u_blode"
								placeholder="Écrivez votre groupe sanguin">
						</div>

						<div class="form-group col-md-6">
							<label for="inputState">Consommation tabac</label>
							<select id="inputState" name="u_tabac" class="form-control">
								<option hidden value="default">Select option</option>
								<option value=0>Non,Je ne consomme pas le tabac</option>
								<option value=1>Oui,Je consomme le tabac</option>
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="inputPassword4">Date de Naissance</label>
							<input type="date" class="form-control" name="u_birthday" placeholder="Date Naissance">
						</div>

						<div class="form-group col-md-6">
							<label for="inputAddress">Lieu de Naissance</label>
							<input type="text" class="form-control" name="u_birthdayAdr"
								placeholder="Entrer lieu de Naissance ">
						</div>

						<div class="form-group col-md-6">
							<label for="inputAddress">Pay Naissance</label>
							<input type="text" class="form-control" name="u_birthdayPay"
								placeholder="Entrer le pay Naissance">
						</div>

						<div class="form-group col-md-6">
							<label for="inputAddress">Profession </label>
							<input type="text" class="form-control" name="u_proffesion" placeholder="Entrer Profession">
						</div>


						<div class="form-group col-md-12">
							<label for="family">Adresse</label>
							<textarea style='resize: none' class="form-control" name="u_proffesionAdr"
								rows="3"></textarea>
						</div>

						<div class="form-group col-md-12">
							<label for="family">Ville</label>
							<textarea style='resize: none' class="form-control" name="u_proffesionVille"
								rows="3"></textarea>
						</div>

						<div class="form-group col-md-6">
							<label for="inputAddress">N°Téléphone</label>
							<input type="text" class="form-control" name="u_phone"
								placeholder="Entrer le numéro Téléphone ">
						</div>

						<div class="form-group col-md-6">
							<label for="inputState">Type Arts</label><br />
							<input type="checkbox" name="u_arts[]" value="Théatre" />Théatre<br />
							<input type="checkbox" name="u_arts[]" value="Cinéma" />Cinéma<br />
							<input type="checkbox" name="u_arts[]" value="Musique Universelle" />Musique
							Universelle<br />
							<input type="checkbox" name="u_arts[]" value="Littérature" />Littérature<br />
							<input type="checkbox" name="u_arts[]" value="Arts plastiques" />Arts plastiques<br />
						</div>

						<div class="form-group col-md-6">
							<label for="inputState">Type Activité sportive</label>
							<select id="inputState" name="u_sport" class="form-control">
								<option hidden value="default">Select option</option>
								<?php
								$get_data = "SELECT * FROM studentsport";
								$run_data = mysqli_query($con,$get_data);
								while($row = mysqli_fetch_array($run_data))
								{
									$id = $row['cid'];
									$name = $row['cname'];
									echo "<option value='$id'>$name</option>";
								}
							?>
							</select>
						</div>

						<div class="form-group col-md-6">
							<label>Photo de vous</label>
							<input type="file" name="image" class="form-control">
						</div>

						<div class="form-group col-md-12">
							<label>Video de vous</label>
							<input type="file" name="video" class="form-control">
						</div>

						<div class="form-group col-md-12">
							<label for="family">Résumé de la personnalité</label>
							<textarea style='resize: none' class="form-control" name="u_family" rows="3"></textarea>
						</div>

						<div class="form-group col-md-6">
							<input type="submit" name="submit" class="btn btn-info btn-large" value="Submit">
						</div>

					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>



	<!------DELETE modal---->
	<!-- Modal -->
	<?php

$get_data = "SELECT * FROM student_data";
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
        <h4 class='modal-title text-center'>Are you want to sure??</h4>
      </div>
      <div class='modal-body'>
        <a href='delete.php?id=$id' class='btn btn-danger' style='margin-left:250px'>Delete</a>
      </div>
    </div>
  </div>
</div>
	";
}

?>


	<!-- View modal  -->
	<?php 
// <!-- profile modal start -->
$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$u_order = $row['u_order'];
	$u_save = $row['u_save'];
	$u_nationaliti = $row['u_nationaliti'];
	$u_drapeau = $row['u_drapeau'];
	$u_adr = $row['u_adr'];
	$u_ville = $row['u_ville'];
	$u_pays = $row['u_pays'];
	$u_email = $row['u_email'];
	$u_f_name = $row['u_f_name'];
	$u_l_name = $row['u_l_name'];
	$u_state = $row['u_state'];
	$u_relegion = $row['u_relegion'];
	$u_blode = $row['u_blode'];
	$u_tabac = $row['u_tabac'];
	$u_birthday = $row['u_birthday'];
	$u_birthdayAdr = $row['u_birthdayAdr'];
	$u_birthdayPay = $row['u_birthdayPay'];
	$u_proffesion = $row['u_proffesion'];
	$u_proffesionAdr = $row['u_proffesionAdr'];
	$u_proffesionVille = $row['u_proffesionVille'];
	$u_phone = $row['u_phone'];
	$u_arts = $row['u_arts'];
	$u_sport = $row['u_sport'];
	$u_family = $row['u_family'];
	$time = $row['uploaded'];
	$image = $row['image'];
	$tabac_= "Non";
	if($u_tabac == 1)
		$tabac_= "Oui";
	echo "
	<div class='modal fade' id='view$id' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
		<div class='modal-header'>
			<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
			<span aria-hidden='true'>&times;</span>
			</button>
		</div>
		<div class='modal-body'>
		<div class='container' id='profile'> 
			<div class='row'>
				<div class='col-sm-4 col-md-8'>
				<h3 class='text-primary'>$u_f_name $u_l_name</h3>
				<p class='text-secondary'>
					<img src='admin/upload_images/$image' alt='' style='width: 200px' ><br>
					<strong>Mon ID :</strong></i> $u_order<br>
					<strong>Numero de telephone :</strong></i>$u_phone<br>
					Date de Naissance : $u_birthday<br>
		
					<strong>Nationalité :</strong> $u_nationaliti <br>
					<strong>Groupe Sanguin :</strong>$u_blode <br>
					<strong>Consomation du tabac :</strong> $tabac_ <br>
					<strong>Religion :</strong> $u_relegion <br>
					<strong>Statut :</strong></i> $u_state<br>
					<strong>Email :</strong></i> $u_email<br>
					<div class='card' style='width: 18rem;'>
					<strong> Familiy :</strong>
							<div class='card-body'>
							<p> $u_family </p>
							</div>
					</div>
					
					<strong> Address : </strong></i> $u_adr, $u_ville, <br> $u_pays
					<br />
					</p>
					<!-- Split button -->
				</div>
			</div>

		</div>   
		</div>
		<div class='modal-footer'>
		</div>
		</form>
		</div>
	</div>
	</div> ";
}


// <!-- profile modal end -->

?>


</body>

</html>