<?php
session_start();
require_once('../includes/root.php');
include_once('../includes/db.php');

if(empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}

global $conn;

if(isset($_POST['contactverkoper'])) {
    // Vars voor bericht
    $gebruikersnaam_gebruiker = $_SESSION['gebruiker'];
    $gebruikersnaam_verkoper = $_POST['gebruikersnaamverkoper'];
    $vraagtype = $_POST['vraagtype'];
    $onderwerp = "eenmaalandermaal - $vraagtype - gebruiker: $gebruikersnaam_gebruiker";
    $bericht = $_POST['invoerveld'];

    // SQL Statements
    $stmt = $conn->prepare("SELECT email FROM Gebruiker WHERE gebruikersnaam ='".$gebruikersnaam_verkoper."'");
    $stmt->execute();
    $result_verkoper = $stmt->fetch(PDO::FETCH_ASSOC);
    $result_verkoper_parsed = $result_verkoper['email'];

    $stmt1 = $conn->prepare("SELECT email FROM Gebruiker WHERE gebruikersnaam ='".$gebruikersnaam_gebruiker."'");
    $stmt1->execute();
    $result_gebruiker = $stmt1->fetch(PDO::FETCH_ASSOC);
    $result_gebruiker_parsed = $result_gebruiker['email'];

    // Bericht voor de verkoper
    $berichtVerkoper = "
        Een gebruiker van EenmaalAndermaal heeft hieronder het volgende gestuurd:

        $bericht

        Terugmailen kan met het volgende adres: $result_gebruiker_parsed
    ";

    // Mails voor respectievelijk de verkoper en gebruiker. Gebruiker krijgt een kopie van de email die gestuurd is
    mail("$result_verkoper_parsed", "$onderwerp", "$berichtVerkoper");
    mail("$result_gebruiker_parsed", "eenmaalandermaal - kopie e-mail", "$bericht");
    header("Location: ../contact/contactVerkoperVoltooid.php");
}