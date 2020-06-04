<?php
include_once('../../../includes/db.php');
session_start();

if (isset($_POST['bewerken'])) {
    $gebruikersnaamoud = $_POST['gebruikersnaamoud'];
    $gebruikersnaamnieuw = $_POST['gebruikersnaamnieuw'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $geboortedag = $_POST['geboortedag'];
    $adresregel1 = $_POST['adresregel1'];
    $adresregel2 = $_POST['adresregel2'];
    $postcode = $_POST['postcode'];
    $plaatsnaam = $_POST['plaatsnaam'];
    $land = $_POST['land'];

    $isVerkoper = $_POST['isVerkoper'];
    $isAdmin = $_POST['isAdmin'];
    $geblokkeerd = $_POST['geblokkeerd'];
    if ($isVerkoper != 1) {
        $isVerkoper = 0;
    }
    if ($isAdmin != 1) {
        $isAdmin = 0;
    }
    if ($geblokkeerd != 1) {
        $geblokkeerd = 0;
    }

    $banknaam = $_POST['banknaam'];
    $rekeningnummer = $_POST['rekeningnummer'];
    $creditcardnummer = $_POST['creditcardnummer'];

    $sql_koper = "UPDATE Gebruiker SET
                  gebruikersnaam = :gebruikersnaamnieuw,
                  voornaam = :voornaam,
                  achternaam = :achternaam,
                  adresregel1 = :adresregel1,
                  adresregel2 = :adresregel2,
                  geboortedag = :geboortedag,
                  postcode = :postcode,
                  plaatsnaam = :plaatsnaam,
                  email = :email,
                  land = :land,
                  isVerkoper = :isVerkoper,
                  isAdmin = :isAdmin,
                  geblokkeerd = :geblokkeerd
                  WHERE gebruikersnaam = :gebruikersnaamoud";

    $stmt = $conn->prepare($sql_koper);

    $stmt->bindParam(':gebruikersnaamnieuw', $gebruikersnaamnieuw);
    $stmt->bindParam(':voornaam', $voornaam);
    $stmt->bindParam(':achternaam', $achternaam);
    $stmt->bindParam(':adresregel1', $adresregel1);
    $stmt->bindParam(':adresregel2', $adresregel2);
    $stmt->bindParam(':postcode', $postcode);
    $stmt->bindParam(':geboortedag', $geboortedag);
    $stmt->bindParam(':plaatsnaam', $plaatsnaam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':land', $land);
    $stmt->bindParam(':isVerkoper', $isVerkoper);
    $stmt->bindParam(':isAdmin', $isAdmin);
    $stmt->bindParam(':geblokkeerd', $geblokkeerd);
    $stmt->bindParam(':gebruikersnaamoud', $gebruikersnaamoud);

    $stmt->execute();

    $sql_verkoper = "UPDATE Verkoper
                     SET gebruikersnaam = :gebruikersnaamnieuw,
                     banknaam = :banknaam,
                     rekeningnummer = :rekeningnummer,
                     creditcardnummer = :creditcardnummer
                     WHERE gebruikersnaam = :gebruikersnaamoud";

    $stmt = $conn->prepare($sql_verkoper);
    $stmt->bindParam(':gebruikersnaamnieuw', $gebruikersnaamnieuw);
    $stmt->bindParam(':gebruikersnaamoud', $gebruikersnaamoud);
    $stmt->bindParam(':banknaam', $banknaam);
    $stmt->bindParam(':rekeningnummer', $rekeningnummer);
    $stmt->bindParam(':creditcardnummer', $creditcardnummer);

    $stmt->execute();

    $_SESSION['success'] = "successAdminGebruikerWijzigen";
    header('Location: ../gebruiker_wijzigen.php?gebruikersnaam=' . $gebruikersnaamnieuw . '');

} else if(isset($_POST['verwijderen'])){
    $gebruikersnaamoud = $_POST['gebruikersnaamoud'];
    $sql_verwijder = "DELETE FROM Gebruiker WHERE gebruikersnaam = :gebruikersnaam";
    $stmt = $conn->prepare($sql_verwijder);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaamoud);
    $stmt->execute();

    $_SESSION['success'] = "successGebruikerVerwijderen";
    header('Location: ../../gebruikers.php');
}
