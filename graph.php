<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include('config.php');

$id = $_GET['id'];

if (!$con) {
echo "Problem in database connection! Contact administrator!" . mysqli_error();
}else{
    if($id == 1)
        $sql ="SELECT cname2 as 'name',count(id) as 'champ' FROM `student_data` JOIN studentnationality WHERE u_nationaliti = studentnationality.cid GROUP BY u_nationaliti ORDER BY `champ` ASC";
    else if($id == 2)
        $sql ="SELECT u_blode as 'name', count(id) as 'champ' FROM student_data GROUP BY name order by 'champ'";
    else if($id == 3)
        $sql ="SELECT u_tabac as 'name', count(id) as 'champ' FROM student_data GROUP BY name order by 'champ'";
    else if($id == 4)
        $sql ="SELECT cname as 'name',count(id) as 'champ' FROM `student_data` JOIN studentsport WHERE u_sport = studentsport.cid GROUP BY u_sport ORDER BY `champ` ASC";
    else if($id == 5)
        $sql ="SELECT u_relegion as 'name', count(id) as 'champ' FROM student_data GROUP BY name order by 'champ'";

    
    
    $result = mysqli_query($con,$sql);
    $chart_data="";
    while ($row = mysqli_fetch_array($result)) { 
        $sportname[]  = $row['name']  ;
        $sport[] = $row['champ'];
    }
    if($id == 3)
    {
        $sportname[0]  = "Ne Consome pas le tabac"  ;
        $sportname[1]  = "Consome le tabac"  ;
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
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
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
			<a class="navbar-brand" href="index.php" style="font-size:30px;"><strong>Les Statistiques</strong></a>
			<ul class="navbar-brand mr-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class='dropdown-item' href="updatesport.php">Sport table</a>
						<div class="dropdown-divider"></div>
						<a class='dropdown-item' href="updatenationaliti.php">Nationalite table</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="updateusers.php">Afficher les utilisateur</a>
						<div class="dropdown-divider"></div>
						<a class='dropdown-item' href="statistique.php">Statistique</a>
					</div>
				</li>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<form class="modal-body" style="text-align:right">
						<a href="Welcome.php" class="btn btn-warning my-2 my-sm-0" type="submit">Profile</a>
						<a href="Logout.php" class="btn btn-danger my-2 my-sm-0" type="submit">Logout</a>
					</form>
				</div>
		</nav>
		<img src="https://www.netoffensive.blog/wp-content/uploads/2019/11/statistiques-referencement-naturel.jpg" class = "marginauto" alt="" width="350px"></a>
		</table>
	</div>
	<div style="modal-content">
        <div style="width:800px;text-align:center">
            <div class="form-group col-md-12">
                <label for="inputAddress" style="  font-size: 40px;">Analytics Reports</label></br>
            </div>
                <canvas  id="chartjs_bar"></canvas> 
            </div>
    </div>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
          <script type="text/javascript">
          var ctx = document.getElementById("chartjs_bar").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels:<?php echo json_encode($sportname); ?>,
                            datasets: [{
                                backgroundColor: [
                                   "#5969ff",
                                    "#ff407b",
                                    "#25d5f2",
                                    "#ffc750",
                                    "#2ec551",
                                    "#7040fa",
                                    "#ff004e"
                                ],
                                data:<?php echo json_encode($sport); ?>,
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks:{
                                        beginAtZero: true
                                    }
                                }]
                            },
                            legend: {
                            display: true,
                            position: 'bottom',
     
                            labels: {
                                fontColor: '#71748d',
                                fontFamily: 'Circular Std Book',
                                fontSize: 20,
                            }
                        },
                    }
                    });
        </script>
</body>
</html>