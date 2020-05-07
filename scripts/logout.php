<?php
// session starten
session_start();

// als variabel gebruikersnaam bestaat dan toegang tot de code eronder
if (isset($_SESSION["gebruikersnaam"])) {
// zet alle variabelen naar null array
    $_SESSION = array();
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