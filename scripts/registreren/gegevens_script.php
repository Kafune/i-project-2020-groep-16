<?php
session_start();
include_once('../../includes/db.php');

if ($_SESSION['registratieStatus'] == 3) {
    if ($_POST['registreren']) {
        $email = $_SESSION['email'];
        $gebruikersnaam = $_SESSION['gebruikersnaam'];
        $wachtwoord = $_SESSION['wachtwoord'];
        $voornaam = strip_tags($_POST['voornaam']);
        $achternaam = strip_tags($_POST['achternaam']);
        $adresregel1 = strip_tags($_POST['adresregel1']);
        $adresregel2 = strip_tags($_POST['adresregel2']);
        $postcode = strip_tags($_POST['postcode']);
        $plaatsnaam = strip_tags($_POST['plaatsnaam']);
        $land = $_POST['land'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $geboortedag = $_POST['geboortedag'];
        $vraag = $_POST['vraag'];
        $antwoord = strip_tags($_POST['antwoord']);

        //maak een datetime object aan die de formaat van de ingevulde formulier veld van de gebruiker overneemt overneemt
        $leeftijdsverificatie = DateTime::createFromFormat('Y-m-d', $geboortedag);
        //kijk naar het verschil tussen de geboortedatum en nu. De tijd van nu wordt gekeken door new DateTime
        $verschil = $leeftijdsverificatie->diff(new DateTime());

        //Zodra gebruiker minder dan 18 jaar is, stuur m terug naar inschrijfformulier. Ga anders door.
        if ($verschil->y < 18) {
            $_SESSION['error'] = "errorMinderJarig";
            header('location: ' . $root . '/registratie/gegevens.php');
        } else {
            $sql = "INSERT INTO Gebruiker (gebruikersnaam, voornaam, achternaam, 
            adresregel1, adresregel2, postcode, plaatsnaam, land, geboortedag, email, wachtwoord, 
            vraag, antwoordtekst, isVerkoper)
        VALUES (:gebruikersnaam, :voornaam, :achternaam, 
            :adresregel1, :adresregel2, :postcode, :plaatsnaam, :land, :geboortedag, :email, :wachtwoord, 
            :vraag, :antwoordtekst, 0);";


            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
            $stmt->bindParam(':wachtwoord', $wachtwoord);
            $stmt->bindParam(':voornaam', $voornaam);
            $stmt->bindParam(':achternaam', $achternaam);
            $stmt->bindParam(':adresregel1', $adresregel1);
            if (isset($adresregel2)) {
                $stmt->bindParam(':adresregel2', $adresregel2);
            }
            $stmt->bindParam(':adresregel2', $adresregel2, PDO::PARAM_NULL);
            $stmt->bindParam(':postcode', $postcode);
            $stmt->bindParam(':plaatsnaam', $plaatsnaam);
            $stmt->bindParam(':land', $land);
            $stmt->bindParam(':geboortedag', $geboortedag);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':vraag', $vraag);
            $stmt->bindParam(':antwoordtekst', $antwoord);

            $stmt->execute();

            $sql = "INSERT INTO GebruikersTelefoon (gebruikersnaam, telefoonnummer)
            VALUES (:gebruikersnaam, :telefoonnummer)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
            $stmt->bindParam(':telefoonnummer', $telefoonnummer);
            $stmt->execute();


            $_SESSION['success'] = "succesAccountAanmaken";
            header('location: /../index.php');
        }
    } else {
        header('location:../../registratie/email.php');
    }
}
?>