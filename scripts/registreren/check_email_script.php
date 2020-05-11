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

    echo "<script>
          alert('U ontvangt nu via uw email een verificatie code! Vergeet niet uw spambox te checken.');
          window.location.href='../../registratie/verificatie_code.php';
          </script>";

} else {
    echo "<script>
          alert('Email is al bekend!');
          window.location.href='../../registratie/email.php';
          </script>";
}
