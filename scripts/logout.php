<?php
// session starten
session_start();

// als variabel gebruikersnaam bestaat dan toegang tot de code eronder
if(isset($_SESSION["gebruikersnaam"])) {
// zet alle variabelen naar null array
    $_SESSION = array();
//destroy session
    session_destroy();
    $message = "Uitgelogd";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location: ../../index.php");
}
else {
    header("Location:login.php");
}

?>