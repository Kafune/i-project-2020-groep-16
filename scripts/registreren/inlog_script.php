<?php
session_start();
include_once('../../includes/db.php');
include_once('../../includes/functies.php');

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
            $_SESSION['error'] = "";

            if (checkWachtwoord($wachtwoord)) {
                $wachtwoordHash = sha1($wachtwoord);

                $_SESSION['gebruikersnaam'] = $gebruikersnaam;
                $_SESSION['wachtwoord'] = $wachtwoordHash;

                $_SESSION['registratieStatus'] = 3;
                header('Location: ../../registratie/gegevens.php');
            } else {
                //verkeerd wachtwoord, stuur gebruiker terug naar zelfde scherm
                echo "<script>
                alert('Ongeldig wachtwoord!');
                window.location.href='../../registratie/inlog.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Gebruikersnaam is al bekend!');
            window.location.href='../../registratie/inlog.php';
            </script>";
        }
    }

} else {
    header('location:../../registratie/email.php');
}
?>