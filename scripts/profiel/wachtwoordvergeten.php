<?php
session_start();
require_once('../../includes/root.php');
require_once('../../includes/db.php');

$_SESSION['email'] = $_POST['email'];

$resultaat = haalGebruikerInfo($conn, $_SESSION['email']);

if (!empty($resultaat)) {
    genereerVerificatieCode();
    verstuurMail($resultaat);
    $_SESSION['wachtwoordVergetenStap'] = 1;
    header('location: /profiel/wachtwoordemailverificatie.php');

} else {
    $_SESSION['error'] = "emailOnbekend";
    header('location: /profiel/wachtwoordvergeten.php');
}


function haalGebruikerInfo($dbconnectie, $email)
{
    //TODO: verander vraag naar een vraag die vanuit de db komt
    //Check eerst of de e-mail al bestaat in de gebruikersdatabase
    $sql = "SELECT email, gebruikersnaam, vraag, antwoordtekst 
            FROM Gebruiker 
            WHERE email = :email";
    $stmt = $dbconnectie->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultaat;
}

//deze check is er voor het geval dat een gebruiker via client zijn gebruikersnaam probeert te manipuleren
function checkGegevens($clientResultaat, $databaseResultaat)
{
    if ($clientResultaat == $databaseResultaat) {
        return true;
    }
    return false;
}

function geefWachtwoordHash($wachtwoord)
{
    return sha1($wachtwoord);
}

function checkWachtwoord($wachtwoord)
{
    //wachtwoord is kleiner dan 7 letters
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

function genereerVerificatieCode()
{
    $verificatiecode = bin2hex(random_bytes(6));
    $_SESSION['verificatieCode'] = $verificatiecode;
}

function verstuurMail($gegevens)
{
    //genereer een verificatiecode en stop deze in de database. onthoud de huidige email. kan ook de email ophalen van de database
    $verificatiecode = bin2hex(random_bytes(6));
    $_SESSION['verificatieCode'] = $verificatiecode;

    //Verstuur mail code

    $naar = $_SESSION['email'];
    $onderwerp = 'Wachtwoord vergeten';
    $bericht = 'Beste klant, ' . "\r\n\r\n";
    $bericht .= 'De gebruiker ' . $gegevens['gebruikersnaam'] . ' die aan deze account is gekoppeld, heeft aangegeven dat u uw wachtwoord bent vergeten.' . "\r\n";
    $bericht .= 'Voer deze verificatiecode in om verder te gaan met het herstellen van uw wachtwoord' . $verificatiecode . "\r\n\r\n";
    $bericht .= 'Met vriendelijke groet, ' . "\r\n";
    $bericht .= 'Veilingsite Eenmaal Andermaal';

    mail($naar, $onderwerp, $bericht);
}