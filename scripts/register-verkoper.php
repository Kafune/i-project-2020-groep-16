<?php
session_start();
require_once('../includes/root.php');
include_once('../includes/db.php');
global $conn;

/* Checkt of de gebruiker is ingelogd */
if (empty($_SESSION['gebruiker'])) {
    header("Location: index.php");
}

/* Checkt of de gebruiker op de submit knop heeft gedrukt */
if (isset($_POST['registreerverkoper'])) {
    $gebruikersnaam = $_SESSION['gebruiker'];
    $banknaam = $_POST['banknaam'];
    $rekeningnummer = $_POST['rekeningnummer'];
    $creditcardnummer = $_POST['creditcardnummer'];

    /* Als de gebruiker geen creditcardnummer heeft ingevoerd, wordt de optie 'post' gekozen*/
    if (!empty($creditcardnummer)) {
        $controleoptie = 'Creditcard';
    } else {
        $controleoptie = 'Post';
    }

    $_SESSION['controleoptie'] = $controleoptie;

    /* Insert de verkoper gegevens in de verkoper tabel */
    $sql = "INSERT INTO Verkoper (gebruikersnaam, banknaam, rekeningnummer, controleoptienaam, creditcardnummer)
            VALUES (
            :gebruikersnaam,
            :banknaam,
            :rekeningnummer,
            :controleoptie,
            :creditcardnummer
            )
           ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->bindParam(':banknaam', $banknaam);
    $stmt->bindParam(':rekeningnummer', $rekeningnummer);
    $stmt->bindParam(':creditcardnummer', $creditcardnummer);
    $stmt->bindParam(':controleoptie', $controleoptie);

    $stmt->execute();

    if ($controleoptie === 'Creditcard') {
        $gebruikersnaam = $_SESSION['gebruiker'];

        /* Zet de isVerkoper variabele in de database op true */
        $sql = "UPDATE Gebruiker SET isVerkoper = 1 WHERE gebruikersnaam = :gebruikersnaam";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);

        $stmt->execute();
        header("Location: /profiel/registrerenVerkoperVoltooid.php");
    } else if ($controleoptie === 'Post') {
        $verificatiecode = uniqid("", true);

        $sql = "UPDATE Verkoper SET controlenummer = :verificatiecode WHERE gebruikersnaam = :gebruikersnaam";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':verificatiecode', $verificatiecode);
        $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmt->execute();

        /* Haalt de gegevens op van de gebruiker voor het versturen van de verficicatie brief */
        $verkoperInfo= $conn->prepare("SELECT * FROM Gebruiker WHERE gebruikersnaam = :gebruikersnaam");
        $verkoperInfo->bindParam(':gebruikersnaam', $gebruikersnaam);
        $verkoperInfo->execute();
        $result = $verkoperInfo->fetch(PDO::FETCH_ASSOC);

        /* Het bericht dat de mederwerker van EenmaalAndermaal ontvangt,
           voor het versturen van de verificatie brief. */
        $bericht = "
        Een gebruiker van eenmaalandermaal wil zich gaan registreren met de optie: verificatie per post. Er zal dus een brief moeten worden gestuurd met de       volgende gegevens:
        
        Gebruikersnaam: {$result['gebruikersnaam']}
        Voornaam: {$result['voornaam']}
        Achternaam: {$result['achternaam']}
        Adres: {$result['adresregel1']} {$result['adresregel2']}
        Postcode: {$result['postcode']}
        Plaatsnaam: {$result['plaatsnaam']}
        Land: {$result['land']}
        Controlenummer: $verificatiecode
        
        Graag zo snel mogelijk opsturen, zodat deze verkoper onze platform kan gaan gebruiken.
        ";


        mail("r.florissen@student.han.nl", "EenmaalAndermaal Verificatiecode per Post", $bericht);
        header("Location: /profiel/registrerenVerkoperVoltooid.php");
    }
}
