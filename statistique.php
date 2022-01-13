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

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>Taches personnalite</title>
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

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['sport', 'student_data'],
         <?php
         $sql = "SELECT * FROM student_data";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['u_sport']."',".$result['student_data']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Students and their contribution'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</head>

<body>

	<div class="container">
		<nav class="modal-content">
			<a class="navbar-brand" href="index.php" style="font-size:30px;"><strong>Cote Statistique</strong></a>
			<ul class="navbar-brand mr-auto">

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<form class="modal-body" style="text-align:right">
						<a href="Welcome.php" class="btn btn-warning my-2 my-sm-0" type="submit">Profile</a>
						<a href="Logout.php" class="btn btn-danger my-2 my-sm-0" type="submit">Logout</a>
					</form>
				</div>
		</nav>
		<img src="https://www.netoffensive.blog/wp-content/uploads/2019/11/statistiques-referencement-naturel.jpg" class = "marginauto" alt="" width="350px"></a>

		<a href="export.php" class="btn btn-success pull-right"><i class="fa fa-download"></i> Export Data</a>
		<hr>
		<table class="table table-bordered table-striped table-hover" id="myTable">
			<thead>
				<tr>
					<th class="text-center" scope="col"></th>
					<th class="text-center" scope="col"> statistiques</th>
					<th class="text-center" scope="col">Graphique Commembert</th>
					<th class="text-center" scope="col">Histogramme</th>
				</tr>
			</thead>
			<?php

        	$get_data = "SELECT * FROM statique order by 1 asc";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['id'];
				$name = $row['name'];
				echo "
				<tr>
					<td class='text-center'>$sl</td>
					<td class='text-left'>$name</td>
					
					<td class='text-center'>
						<span>";
						?>
							<a href='chart.php?id=<?php echo $id?>' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#showstats$id' title='Afficher'>
						<i class='fa fa-address-card-o'></i>
					</a>
					<?php
					echo "
					</span>
				</td>
				
				<td class='text-center'>
					<span>";
					?>
						
						<a href='graph.php?id=<?php echo $id?>' class='btn btn-success mr-3 profile' title='Afficher'>
						     <i class='fa fa-address-card-o' data-toggle='modal' data-target='#$id' style='' aria-hidden='true'></i>
							</a>
					<?php
					echo "
					</span>
				</td>
				</tr>";
        	}

        	?>



		</table>
		<form method="post" action="export.php">
			<input type="submit" name="export" class="btn btn-success" value="Export Data" />
		</form>
	</div>


	<!---Add in modal---->

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div>
						<img src="https://i.pinimg.com/originals/21/71/70/21717044bafb18599fd98f3b3a59ad6b.jpg" class ="marginauto" width="350px" alt="">
					</div>

				</div>
				<div class="modal-body">
					<form method="POST" enctype="multipart/form-data">

						<div class="form-group col-md-12">
							<label for="inputAddress">Le nom du nationalite</label>
							<input type="text" class="form-control" name="u_sport" placeholder="Entrer le nom">
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

$get_data = "SELECT * FROM studentnationality";
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
				<h4 class='modal-title text-center'>$id</h4> 
			</div>
			<div class='modal-footer'>
		    	<div id='piechart' width: 900px height: 500px ></div>
 			</div>
		</div>
	</div>
</div>
";
}
?>

<?php

$get_data = "SELECT * FROM studentnationality";
$run_data = mysqli_query($con,$get_data);
while($row = mysqli_fetch_array($run_data))
{
	$id = $row['cid'];
	
	$u_sport = $row['cname2'];

	echo "
	
	<div id='showstats$id' class='modal fade' role='dialog'>
	<div class='modal-dialog'>
  
	  <!-- Modal content-->
	  <div class='modal-content'>
		<div class='modal-header'>
			   <button type='button' class='close' data-dismiss='modal'>&times;</button>
			   <h4 class='modal-title text-center'>$u_sport</h4> 
		</div>
  
					<div class='modal-body'>
						<form action='editnationaliti.php?id=$id' method='post' enctype='multipart/form-data'>

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
	<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#myTable').DataTable();
		});
	</script>

</body>

</html>