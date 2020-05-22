<?php
//TODO: De eerste 3 functies kan beter aangepakt worden.

// functie waarbij er één parameter gebruikt wordt om op een database record te zoeken.
function haalGegevens($dbconnectie, $sql, $bindparameter, $bindvariabel) {
    //Check eerst of de e-mail al bestaat in de gebruikersdatabase
    $stmt = $dbconnectie->prepare($sql);
    $stmt->bindParam($bindparameter, $bindvariabel);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// functie waarbij er meerdere parameters gebruikt wordt om op een database record te zoeken.
function haalGegevensArray($dbconnectie, $sql, $array) {
    //Check eerst of de e-mail al bestaat in de gebruikersdatabase
    $stmt = $dbconnectie->prepare($sql);
    $stmt->execute($array);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function voerQueryUit($dbconnectie, $sql, $array) {
    $stmt = $dbconnectie->prepare($sql);
    $stmt->execute($array);
    return $stmt;
}


//Controle van sessie met daadwerkelijke database resultaat
function checkGegevens($clientResultaat, $databaseResultaat)
{
    if ($clientResultaat == $databaseResultaat) {
        return true;
    }
    return false;
}

// Controle op wachtwoord
function checkWachtwoord($wachtwoord)
{
    //wachtwoord is kleiner dan 7 letters
    if (strlen($wachtwoord) < 7) {
        $_SESSION['error'] = "errorWachtwoordLengte";
        return false;
    }

    //wachtwoord bevat geen grote of kleine letter
    if (!preg_match("#[a-zA-Z]+#", $wachtwoord)) {
        $_SESSION['error'] = "errorWachtwoordLetters";
        return false;
    }

    //wachtwoord bevat geen cijfer
    if (!preg_match("#[0-9]+#", $wachtwoord)) {
        $_SESSION['error'] = "errorWachtwoordCijfers";
        return false;
    }

    return true;
}

//hash de wachtwoord m.b.v. de SHA1 algoritme
function geefWachtwoordHash($wachtwoord) {
    return sha1($wachtwoord);
}

function genereerVerificatieCode()
{
    return bin2hex(random_bytes(6));
}

// TODO refactor
function verstuurMail($resultaat)
{
    //genereer een verificatiecode en stop deze in de database. onthoud de huidige email. kan ook de email ophalen van de database
    $_SESSION['verificatieCode'] = genereerVerificatieCode();

    //Verstuur mail code

    $naar = $_SESSION['email'];
    $onderwerp = 'Wachtwoord vergeten';
    $bericht = 'Beste klant, ' . "\r\n\r\n";
    $bericht .= 'De gebruiker ' . $resultaat['gebruikersnaam'] . ' die aan deze account is gekoppeld, heeft aangegeven dat u uw wachtwoord bent vergeten.' . "\r\n";
    $bericht .= 'Voer deze verificatiecode in om verder te gaan met het herstellen van uw wachtwoord' . $_SESSION['verificatieCode'] . "\r\n\r\n";
    $bericht .= 'Met vriendelijke groet, ' . "\r\n";
    $bericht .= 'Veilingsite Eenmaal Andermaal';

    mail($naar, $onderwerp, $bericht);
}