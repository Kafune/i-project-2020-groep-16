<?php
session_start();
include_once('../../includes/db.php');

if ($_SESSION['registratieStatus'] == 3) {
    $email = $_SESSION['email'];
    $gebruikersnaam = $_SESSION['gebruikersnaam'];
    $wachtwoord = $_SESSION['wachtwoord'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $adresregel1 = $_POST['adresregel1'];

    if(!isset($_POST['adresregel2'])){
        $adresregel2 = "";
    } else {
        $adresregel2 = $_POST['adresregel2'];
    }

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
    header('location: ../../index.php');

} else {
    echo "FOUT";
    header('location:../../registratie/email.php');
}
?>