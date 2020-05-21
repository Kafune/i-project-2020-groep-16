<?php
// session starten
session_start();

// als variabel gebruikersnaam bestaat dan toegang tot de code eronder
if ($_SESSION["ingelogd"]== true) {
// zet alle variabelen naar null array
    $_SESSION = array();
    $_SESSION['ingelogd'] = false;
//destroy session
    session_destroy();
    $_SESSION['success'] = "succesUitloggen";
    header('location: /index.php');
} else {
    header("Location:login.php");
}

?>