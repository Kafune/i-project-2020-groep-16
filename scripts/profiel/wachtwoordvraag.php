<?php
session_start();
require_once('../../includes/root.php');
require_once('../../includes/db.php');
require_once('../../includes/functies.php');

$_SESSION['geheimevraagnr'] = $_POST['geheimevraagnr'];
$_SESSION['geheimeantwoord'] = $_POST['geheimeantwoord'];

$sql = "SELECT vraag, antwoordtekst
            FROM Gebruiker
            WHERE email = :email AND vraag = :vraag AND antwoordtekst = :antwoord";

$queryArray = array(
    ':email' => $_SESSION['email'],
    ':vraag' => $_SESSION['geheimevraagnr'],
    ':antwoord' => $_SESSION['geheimeantwoord']
);

//haal gebruiker van database
$resultaat = haalGegevensArray($conn, $sql, $queryArray);

//kijk of gebruiker bestaat. zo ja, maak verificatiecode aan
if (!empty($resultaat)) {
    $_SESSION['wachtwoordVergetenStap'] = 3;
    header('location: /profiel/wachtwoordveranderen.php');
} else {
    $_SESSION['error'] = "errorVraagOnjuist";
    header('location: /profiel/wachtwoordvraag.php');
}
