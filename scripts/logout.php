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
    echo "<script>
    alert('U bent nu uitgelogd!');
    window.location.href='../../index.php';
    </script>";
} else {
    header("Location:login.php");
}

?>