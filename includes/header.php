<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/css/mystyles.css">
    <title>Eenmaal Andermaal</title>
</head>
<body>
<nav class="navbar is-primary">
    <div class="navbar-brand">
        <a class="navbar-item" href="index.php">
            <img src="sources/Logo.png" alt="Eenmaal Andermaal">
        </a>
        <div class="navbar-burger burger" data-target="navMenuColorprimary-example">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>


    <div class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="../index.php">Home</a>
            <a class="navbar-item" href="#">Categoriën</a>
            <a class="navbar-item" href="#">Top Veilingen</a>
            <a class="navbar-item" href="../contact.php">Contact</a>
        </div>
        <div class="navbar-end">
            <?php
            if(!ISSET($_SESSION['gebruiker'])) {
                echo '<a class="button is-black" href="registreren.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Registreren</a>
                  <a class="button is-black" href="login.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Log In</a>';
            } else {
                echo '<a class="button is-black" href="#" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Mijn Profiel</a>
                  <a class="button is-black" href="scripts/logout.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Uitloggen</a>';
            }
            ?>
        </div>
    </div>
</nav>
</body>
