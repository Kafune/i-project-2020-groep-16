<?php
session_start();
include_once("root.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/styles/css/mystyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Eenmaal Andermaal</title>
</head>
<body>
<nav class="navbar is-primary">
    <div class="navbar-brand">
        <a class="navbar-item" href="/index.php">
            <img src="/sources/Logo.png" alt="Eenmaal Andermaal">
        </a>
        <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>



    <div class="navbar-menu" id="navMenu">
        <div class="navbar-start">
            <a class="navbar-item" href="/index.php">Home</a>
            <a class="navbar-item" href="/producten/rubrieken.php?volgnr=1">Categoriën</a>
            <a class="navbar-item" href="#">Top Veilingen</a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Contact</a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/contact.php">Contact EenmaalAndermaal</a>
                    <a class="navbar-item" href="/contact/ContactVerkoper.php">Contact Verkoper</a>
                </div>
            </div>
        </div>
        <div class="navbar-end">
            <?php

            if (!isset($_SESSION['ingelogd'])) {
                echo '<a class="button is-black" href="/registratie/email.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Registreren</a>
                  <a class="button is-black" href="/login.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Log In</a>';
            } else {
                if (isset($_SESSION['verkoper'])) {
                    echo '<a class="button is-black" href="/producten/rubrieken.php?volgnr=1" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Verkoop</a>';
                }

                echo '<a class="button is-black" href="/profiel/gebruikersprofiel.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Mijn Profiel</a>
                  <a class="button is-black" href="/scripts/logout.php" style="margin-right: 2rem; margin-top: auto; margin-bottom: auto">Uitloggen</a>';
            }
            ?>
        </div>
    </div>
</nav>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        // Get all "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {

                    // Get the target from the "data-target" attribute
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);

                    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });
        }

    });
</script>
