<?php
session_start();
require_once('../../includes/root.php');
include_once('../../includes/db.php');

//check of gebruiker is ingelogd
if (isset($_SESSION['gebruiker'])) {
    //check of gebruiker daadwerkelijk op verzenden knop heeft gedrukt

    $gebruikersnaam = $_SESSION['gebruiker'];

    $sql = "SELECT gebruikersnaam, wachtwoord FROM Gebruiker WHERE gebruikersnaam = :gebruikersnaam";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->execute();

    $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);

    // Checkt of gebruiker bestaat
    if (!empty($resultaat)) {
        // check of ingelogde gebruiker overeen komt met opgehaalde gebruiker.
        // laat gebruiker anders niet bewerken
        if ($gebruikersnaam == $resultaat['gebruikersnaam']) {
            // kijk of de gebruiker op de verzendknop heeft geklikt
            if (isset($_POST['bewerken'])) {

                $wachtwoord = $_POST['wachtwoord'];
                $hashedWachtwoord = sha1($wachtwoord);

                // Checkt eerst of het wachtwoord klopt, voordat de query wordt uitgevoerd
                if ($hashedWachtwoord == $resultaat['wachtwoord']) {
                    $voornaam = $_POST['voornaam'];
                    $achternaam = $_POST['achternaam'];
                    $adresregel1 = $_POST['adresregel1'];
                    $adresregel2 = $_POST['adresregel2'];
                    $postcode = $_POST['postcode'];
                    $plaatsnaam = $_POST['plaatsnaam'];
                    $land = $_POST['land'];

                    // Update de gebruikers gegevens in de database.
                    $sql = "UPDATE Gebruiker 
                            SET voornaam = :voornaam, achternaam = :achternaam, adresregel1 = :adresregel1,
                            adresregel2 = :adresregel2, postcode = :postcode, plaatsnaam = :plaatsnaam, land = :land
                            WHERE gebruikersnaam = :gebruikersnaam";

                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':voornaam', $voornaam);
                    $stmt->bindParam(':achternaam', $achternaam);
                    $stmt->bindParam(':adresregel1', $adresregel1);
                    $stmt->bindParam(':adresregel2', $adresregel2);
                    $stmt->bindParam(':postcode', $postcode);
                    $stmt->bindParam(':plaatsnaam', $plaatsnaam);
                    $stmt->bindParam(':land', $land);
                    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);


                    $stmt->execute();

                    $_SESSION['success'] = "succesGegevensBewerkt";
                    header('location: ../../profiel/gebruikersprofiel.php');
                } else {
                    $_SESSION['error'] = 'errorWachtwoordOngeldig';
                    header('location: ../../profiel/profielbewerken.php');
                }
            }
        }
    } else {
        header("Location: /index.php");
    }

} else {
    header("Location: /index.php");
}