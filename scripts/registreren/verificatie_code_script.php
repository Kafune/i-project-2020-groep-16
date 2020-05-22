<?php
session_start();
echo $_SESSION['registratieStatus'];

if($_SESSION["registratieStatus"] == 1) {

    if (isset($_POST['codeCheck'])) {
        $verificatiecode = $_POST['code'];

        if ($verificatiecode == $_SESSION['verificatieCode']) {
            $_SESSION["registratieStatus"] = 2;
            header('location: /registratie/inlog.php');
        } else {
            $_SESSION['error'] = "errorVerificatieOnjuist";
            header('location: /registratie/verificatie_code.php');
        }
    }
} else {
    //stuur gebruiker terug naar registratiepagina op moment dat de gebruiker direct de verificatie pagina bezoekt
    header('location:../../registratie/email.php');
}
?>