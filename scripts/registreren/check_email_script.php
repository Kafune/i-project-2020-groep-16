<?php

session_start();
require_once('../../includes/root.php');
require_once('../../includes/db.php');

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

    //Zorg dat de klant naar de volgende stap kan
    $_SESSION['registratieStatus'] = 1;

    $message = "Email verstuurd!";
    echo "<script type='text/javascript'>alert('$message');</script>";

    header('location:../../registratie/verificatie_code.php');
} else {
    $message = "Email is al bekend!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Refresh:3;Location: ../../registratie/email.php");

}
