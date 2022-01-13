<?php
include('config.php');

$id = $_GET['id'];

if(isset($_POST['submit']))
{
	$u_order = $_POST['u_order'];
	$u_save = $_POST['u_save'];
	$u_nationaliti = $_POST['u_nationaliti'];
	$u_drapeau = $_POST['u_drapeau'];
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
	
	$msgs = "";
	$u_drapeau = $_FILES['u_drapeau']['name'];
	$targets = "upload_images/".basename($u_drapeau);

	if (move_uploaded_file($_FILES['u_drapeau']['tmp_name'], $targets)) {
  		$msgs = "Image uploaded successfully";
  	}else{
  		$msgs = "Failed to upload image";
  	}

	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "upload_images/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
	$ch = implode("|",$u_arts);
	$update = "UPDATE student_data SET u_order='$u_order',u_save='$u_save',u_nationaliti='$u_nationaliti',u_drapeau='$u_drapeau',u_adr='$u_adr',u_ville='$u_ville',u_pays='$u_pays',u_email='$u_email',u_f_name='$u_f_name',u_l_name='$u_l_name',u_state='$u_state',u_relegion='$u_relegion',u_blode='$u_blode',u_tabac='$u_tabac',u_birthday='$u_birthday',u_birthdayAdr='$u_birthdayAdr',u_birthdayPay='$u_birthdayPay',u_proffesion='$u_proffesion',u_proffesionAdr='$u_proffesionAdr',u_proffesionVille='$u_proffesionVille',u_phone='$u_phone',u_arts='$ch',u_sport='$u_sport',image='$image',u_family='$u_family' WHERE id=$id";

	if (mysqli_query($con, $update)) {
		header('location:index.php');
	} else {
  		echo "Error updating record: " . mysqli_error($conn);
	}
}

?>