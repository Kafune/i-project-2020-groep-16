<?php
session_start();
include_once('../../includes/db.php');

if ($_SESSION["registratieStatus"] == 2) {
    if (isset($_POST['accountCheck'])) {
        $gebruikersnaam = $_POST['gebruikersnaam'];

        $sql = "SELECT gebruikersnaam FROM Gebruiker
            WHERE gebruikersnaam = :gebruikersnaam";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmt->execute();

        $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($resultaat)) {
            $wachtwoord = $_POST['wachtwoord'];
            $_SESSION['wachtwoordCheck'] = "";

            if (checkWachtwoord($wachtwoord)) {
                $wachtwoordHash = sha1($wachtwoord);

                $_SESSION['gebruikersnaam'] = $gebruikersnaam;
                $_SESSION['wachtwoord'] = $wachtwoordHash;

                $_SESSION['registratieStatus'] = 3;
                header('Location: ../../registratie/gegevens.php');
            } else {
                //verkeerd wachtwoord, stuur gebruiker terug naar zelfde scherm
                $message = "Ongeldig wachtwoord";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
    }

} else {
    header('location:../../registratie/email.php');
}

function checkWachtwoord($wachtwoord)
{
    if (strlen($wachtwoord) < 7) {
        $_SESSION['wachtwoordCheck'] = "lengte";
        return false;
    }

    //wachtwoord bevat geen grote of kleine letter
    if (!preg_match("#[a-zA-Z]+#", $wachtwoord)) {
        $_SESSION['wachtwoordCheck'] = "letters";
        return false;
    }

    //wachtwoord bevat geen cijfer
    if (!preg_match("#[0-9]+#", $wachtwoord)) {
        $_SESSION['wachtwoordCheck'] = "cijfers";
        return false;
    }

    return true;
}
?>