<?php
include('config.php');

$id = $_GET['id'];

if(isset($_POST['submit']))
{
	$u_sport = $_POST['u_sport'];

	if(empty(trim($_POST["u_sport"]))){
		$isempty = true;
        header('location:updatesport.php');
    } else{
        // Prepare a select statement
        $sql = "SELECT cid FROM studentnationality WHERE cname2 = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){

            mysqli_stmt_bind_param($stmt,'s', $param_username);
            
            $param_username = trim($_POST["u_sport"]);
            
            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
					$indb = true;
					header('location:updatesport.php');
                } else{
                    $u_sport = trim($_POST["u_sport"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }


	$update = "UPDATE `studentnationality` SET `cname2`='$u_sport' WHERE cid = $id";



	
	if (mysqli_query($con, $update)) {
		header('location:updatenationaliti.php');
	} else {
  		echo "Error updating record: " . mysqli_error($conn);
	}
}

?>