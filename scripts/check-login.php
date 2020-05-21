<?php
session_start();
require_once('../includes/root.php');
include_once('../includes/db.php');

// check of de user alle twee velden heeft ingevuld en dan pas de code hieronder uitvoeren
if (isset($_POST['login'])) {


// gebruikersnaam checken of het bestaat

    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];
    $statement = "SELECT * FROM Gebruiker WHERE gebruikersnaam = :gebruikersnaam";
    $stmt = $conn->prepare($statement);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    $verkoper = $row['isVerkoper'];
    $server_password = $row['wachtwoord'];
    $password = sha1($wachtwoord);

//wachtwoord checken of het correct is
    if ($server_password == $password) {
        echo "Succesvol login";

        $_SESSION['gebruiker'] = $gebruikersnaam;
        $_SESSION['ingelogd'] = true;

        if($verkoper == true){
            $_SESSION['verkoper'] = true;
        }
        $_SESSION['success'] = 'succesInloggen';
        header('location: ' . $root . '/index.php');
    } else {
        $_SESSION['error'] = "errorOnjuistLogin";
        header('location: ' . $root . '/login.php');
    }
} // als velden niet ingevuld zijn dan pagina refresh
else {
    header('location: ' . $root . '/login.php');
}
?>