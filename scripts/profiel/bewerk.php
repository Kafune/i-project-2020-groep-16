<?php
session_start();
require_once('../../includes/root.php');
include_once('../../includes/db.php');


//$aanvraagmethode = $_SERVER['REQUEST_METHOD'];
//
//switch($aanvraagmethode) {
//    case 'PUT':
//        $data = json_decode(file_get_contents("php://input"));
//}

//check of gebruiker is ingelogd
if (isset($_SESSION['gebruiker'])) {
    //check of gebruiker daadwerkelijk op verzenden knop heeft gedrukt

    $gebruikersnaam = $_SESSION['gebruiker'];

    $sql = "SELECT gebruikersnaam, wachtwoord FROM Gebruiker WHERE gebruikersnaam = :gebruikersnaam";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->execute();

    $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);

    //check of gebruiker bestaat
    if (!empty($resultaat)) {
        // check of ingelogde gebruiker overeen komt met opgehaalde gebruiker.
        // laat gebruiker anders niet bewerken
        if ($gebruikersnaam == $resultaat['gebruikersnaam']) {
            // kijk of de gebruiker op de verzendknop heeft geklikt
            if (isset($_POST['bewerken'])) {

                $wachtwoord = $_POST['wachtwoord'];
                $hashedWachtwoord = sha1($wachtwoord);

                // check daarna of de gebruiker de wachtwoord heeft ingevoerd voordat de wachtwoord verandering ingaat.
                if ($hashedWachtwoord == $resultaat['wachtwoord']) {
                    $voornaam = $_POST['voornaam'];
                    $achternaam = $_POST['achternaam'];
                    $adresregel1 = $_POST['adresregel1'];
                    $adresregel2 = $_POST['adresregel2'];
                    $postcode = $_POST['postcode'];
                    $plaatsnaam = $_POST['plaatsnaam'];
                    $land = $_POST['land'];


                    $sql = "UPDATE Gebruiker 
                SET voornaam = :voornaam, achternaam = :achternaam, adresregel1 = :adresregel1,
                adresregel2 = :adresregel2, postcode = :postcode, plaatsnaam = :plaatsnaam, land = :land
                WHERE gebruikersnaam = :gebruikersnaam";

                    //voer query uit wanneer wachtwoord correct is


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

                    header('location: /gebruikersprofiel.php');
                } else {
                    $_SESSION['wachtwoordinvoer'] = 'incorrect';
                    header('location: /profielbewerken.php');
                }
            }
        }
    } else {
        header("Location: /index.php");
    }

} else {
    header("Location: /index.php");
}