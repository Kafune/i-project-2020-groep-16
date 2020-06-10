<?php
session_start();
require_once('../includes/root.php');
include_once('../includes/db.php');

// Checkt of de gebruiker alle twee velden heeft ingevuld
if (isset($_POST['login'])) {

    /* Haalt de gegevens van de gebruiker op */
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];
    $statement = "SELECT * FROM Gebruiker WHERE gebruikersnaam = :gebruikersnaam";
    $stmt = $conn->prepare($statement);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    $verkoper = $row['isVerkoper'];
    $isAdmin = $row['isAdmin'];
    $geblokkeerd = $row['geblokkeerd'];
    $server_password = $row['wachtwoord'];
    $password = sha1($wachtwoord);

/* Checkt of de gebruiker geblokkeerd en of het wachtwoord juist is */
    if ($geblokkeerd == 1) {
        $_SESSION['error'] = "errorGeblokkeerd";
        header('location: /login.php');
    } else if ($server_password == $password) {
        $_SESSION['gebruiker'] = $gebruikersnaam;
        $_SESSION['ingelogd'] = true;

        /* Zet de sessie verkoper op waar, zodat de gebruiker verkoper rechten heeft */
        if ($verkoper == true) {
            $_SESSION['verkoper'] = true;
        }

        /* Zet de sessie admin op waar, zodat de gebruiker admin rechten heeft */
        if ($isAdmin == true) {
            $_SESSION['admin'] = true;
        }
        header('location: ' . $root . '/index.php');
    } else {
        $_SESSION['error'] = "errorOnjuistLogin";
        header('location: ' . $root . '/login.php');
    }
} /* Als de velden niet ingevuld zijn dan wordt de gebruiker weer terug gestuurd. */
else {
    header('location: ' . $root . '/login.php');
}
?>