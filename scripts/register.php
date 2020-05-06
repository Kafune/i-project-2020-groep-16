<?php

require_once('../includes/root.php');
require_once(ROOT . '/includes/db.php');

session_start();


if (isset($_POST['emailCheck'])) {
    $email = $_POST['email'];

    //Check eerst of de e-mail al bestaat in de gebruikersdatabase

    $sql = "SELECT email FROM Gebruiker WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);


    if (empty($resultaat)) {
        //genereer een verificatiecode en stop deze in de database. onthoud de huidige email. kan ook de email ophalen van de database
        $_SESSION['email'] = $email;
        $verificatiecode = bin2hex(random_bytes(6));
        $_SESSION['verificatieCode'] = $verificatiecode;

        //Verstuur mail code

        $naar = $_SESSION['email'];
        $onderwerp = 'Bevestig uw email';
        $bericht = 'Beste gebruiker, ' . "\r\n\r\n";
        $bericht .= 'Om verder te gaan met de registratie van uw account, moet u deze code invoeren: ' . $verificatiecode . "\r\n\r\n";
        $bericht .= 'Met vriendelijke groet, ' . "\r\n";
        $bericht .= 'Veilingsite Eenmaal Andermaal';

        mail($naar, $onderwerp, $bericht);

        //start verificatie.
        $_SESSION['verificatieCheck'] = 0;

        //Zorg dat de klant naar de volgende stap kan
        $_SESSION['registratieStatus'] = 1;

    } else {
        $_SESSION['emailBestaat'] = true;
    }
    header('location: ' . $root . '/registreren.php');
}

if (isset($_POST['codeCheck'])) {
    $email = $_SESSION['email'];
    $verificatiecode = $_POST['code'];

//    $sql = "SELECT email, verificatiecode FROM gebruikersverificatie
//            WHERE email = :email AND verificatiecode = :verificatiecode";
//
//    $stmt = $conn->prepare($sql);
//
//    $stmt->bindParam(':email', $email);
//    $stmt->bindParam(':verificatiecode', $verificatiecode);
//    $stmt->execute();
//
//    $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($verificatiecode == $_SESSION['verificatieCode']) {
        $_SESSION['registratieStatus'] = 2;
    } else {
        $_SESSION['verificatieCheck'] = 1;
    }

    header('location: ' . $root . '/registreren.php');
}

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
            $wachtwoordHash = password_hash($wachtwoord, PASSWORD_DEFAULT);

            $_SESSION['gebruikersnaam'] = $gebruikersnaam;
            $_SESSION['wachtwoord'] = $wachtwoordHash;

            $_SESSION['registratieStatus'] = 3;
        } else {
            //verkeerd wachtwoord, stuur gebruiker terug naar zelfde scherm
            header('location: ' . $root . '/registreren.php');
        }


    }
    header('location: ' . $root . '/registreren.php');

}

if (isset($_POST['registreren'])) {
    $email = $_SESSION['email'];
    $gebruikersnaam = $_SESSION['gebruikersnaam'];
    $wachtwoord = $_SESSION['wachtwoord'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $adresregel1 = $_POST['adresregel1'];
    $adresregel2 = $_POST['adresregel2'];
    $postcode = $_POST['postcode'];
    $plaatsnaam = $_POST['plaatsnaam'];
    $land = $_POST['land'];
    $geboortedag = $_POST['geboortedag'];
    $vraag = $_POST['vraag'];
    $antwoord = $_POST['antwoord'];

    $sql = "INSERT INTO Gebruiker (gebruikersnaam, voornaam, achternaam, 
            adresregel1, adresregel2, postcode, plaatsnaam, land, geboortedag, email, wachtwoord, 
            vraag, antwoordtekst, isVerkoper)
        VALUES (:gebruikersnaam, :voornaam, :achternaam, 
            :adresregel1, :adresregel2, :postcode, :plaatsnaam, :land, :geboortedag, :email, :wachtwoord, 
            :vraag, :antwoordtekst, 0)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->bindParam(':wachtwoord', $wachtwoord);
    $stmt->bindParam(':voornaam', $voornaam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':adresregel1', $adresregel1);
    $stmt->bindParam(':adresregel2', $adresregel2);
    $stmt->bindParam(':postcode', $postcode);
    $stmt->bindParam(':plaatsnaam', $plaatsnaam);
    $stmt->bindParam(':land', $land);
    $stmt->bindParam(':geboortedag', $geboortedag);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':vraag', $vraag);
    $stmt->bindParam(':antwoordtekst', $antwoord);

    $stmt->execute();

    $_POST = array(); //reset alle post waarden

    header('location: ' . $root . '/registreren.php');

}

// check of de wachtwoord aan de eisen voldoet
// zet session op basis van message zodat gebruiker weet waar het fout gaat.
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