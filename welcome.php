<?php
// Initialize the session
session_start();

include ('config.php');
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


$afficher_profil = $DB->query("SELECT * FROM users WHERE id = ?",
        array($_SESSION['id']));

    $afficher_profil = $afficher_profil->fetch();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <!-- Bootstrap CSS -->
  

 
</head>

<body>


    <!-- Navigation menu -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#" style="font-size:36px;">
          
        </a>

        <form class="form-inline my-2 my-lg-0" dir="rtl">
            <a href="logout.php" class="btn btn-primary" ><i class="fa fa-lock-open"></i>Logout</a>
        </form>
    </nav>
    <p>
        <div class="container">
            <div class="page-header">
                <h1>Bienvenue <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
            </div>
            <hr>
        </div>
        <a href="index.php" class="btn btn-danger">Accueil</a><br/><br/>
    </p>



    <h2>Voici le profil de <?= $afficher_profil['username']  ?></h2>

        <div>Quelques informations sur vous : </div>
            <ul>
                <li>Votre id est : <?= $afficher_profil['id'] ?></li>
                <li>Votre mail est : <?= $afficher_profil['admin'] ?></li>
                <li>Votre compte a �t� cr�e le : <?= $afficher_profil['created_at'] ?></li>
            </ul>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>

</html>