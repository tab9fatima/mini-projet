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
        if($id == 3)
        {

            $tabac = "Consome le tabac";
            if($row['name'] == "0")
                $tabac = "Ne Consome pas le tabac";
                $sportname[]  = "['".
                                $tabac.
                                "',".
                                $row['champ']."],";
        }
        else
        {
            $sportname[]  = "['".
            $row['name'].
            "',".
            $row['champ']."],";
        }
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                <?php
                foreach($sportname as $sportname)
                {
                    echo $sportname;
                }
                ?>
            ]);

            var options = {
                title: 'Comemberts',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
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
        <img src="https://www.netoffensive.blog/wp-content/uploads/2019/11/statistiques-referencement-naturel.jpg"
            class="marginauto" alt="" width="350px"></a>
        </table>
    </div>
    <div style="modal-content">
        <div style="width:800px;text-align:center">
            <label for="inputAddress" style="  font-size: 40px;">Analytics Reports</label></br>
        </div>
    </div>
    <div id="piechart_3d" style="width: 900px; height: 500px;">
    </div>
</body>

</html>