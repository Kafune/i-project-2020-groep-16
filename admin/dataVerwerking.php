<?php
include_once('../includes/db.php');
session_start();

/*IsAdmin Check*/
$sqlAdmin = "SELECT isAdmin FROM Gebruiker where gebruikersnaam = :gebruikersnaam";
$result = $conn->prepare($sqlAdmin);
$result->bindParam(':gebruikersnaam', $_SESSION['gebruiker']);
$result->execute();
if($result->fetchColumn == 1){
    $_SESSION['admin'] = true;
}


/*SQL Code voor het ophalen van de aantallen*/
$sql_gebruikers = "SELECT count(*) FROM Gebruiker";
$result = $conn->prepare($sql_gebruikers);
$result->execute();
$aantalgebruikers = $result->fetchColumn();

$sql_verkopers = "SELECT count(*) FROM Verkoper";
$result = $conn->prepare($sql_verkopers);
$result->execute();
$aantalverkopers = $result->fetchColumn();

$sql_voorwerpen = "SELECT count(*) FROM Voorwerp";
$result = $conn->prepare($sql_voorwerpen);
$result->execute();
$aantalvoorwerpen = $result->fetchColumn();
$_SESSION['aantalvoorwerpen'] = $aantalvoorwerpen;

$sql_rubrieken = "SELECT count(*) FROM Rubriek";
$result = $conn->prepare($sql_rubrieken);
$result->execute();
$aantalrubrieken = $result->fetchColumn();

/*SQL Code voor het ophalen van de admin gegevens*/
$sqlKoper = "SELECT voornaam FROM Gebruiker where gebruikersnaam = :gebruikersnaam";
$result = $conn->prepare($sqlKoper);
$result->bindParam(':gebruikersnaam', $_SESSION['gebruiker']);
$result->execute();
$result = $result->fetch();
$voornaam = $result['voornaam'];

?>
