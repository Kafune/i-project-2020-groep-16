<?php
session_start();
require_once('../includes/root.php');
include_once('../includes/db.php');

if(empty($_SESSION['gebruiker'])) {
    header("Location: index.php");
}

global $conn;

if(isset($_POST['registreerverkoper'])) {

    $gebruikersnaam = $_SESSION['gebruiker'];
    $banknaam = $_POST['banknaam'];
    $rekeningnummer = $_POST['rekeningnummer'];
    $creditcardnummer = $_POST['creditcardnummer'];

    if(empty($_SESSION['creditcardnummer'])) {
        $controleoptie = 'Post';
    } else {
        $controleoptie = 'Creditcard';
    }

    $sql = "INSERT INTO Verkoper
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

    $gebruikersnaam = $_SESSION['gebruiker'];

    $sql = "UPDATE Gebruiker SET isVerkoper = 1 WHERE gebruikersnaam = :gebruikersnaam";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);

    $stmt->execute();

    header("Location: ../index.php");
}