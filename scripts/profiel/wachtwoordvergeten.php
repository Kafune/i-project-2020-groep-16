<?php
session_start();
require_once('../../includes/root.php');
require_once('../../includes/db.php');
include_once ('../../includes/functies.php');

$_SESSION['email'] = $_POST['email'];

$sql = "SELECT email, gebruikersnaam, vraag, antwoordtekst
            FROM Gebruiker
            WHERE email = :email";

$resultaat = haalGegevens($conn, $sql, ':email', $_SESSION['email']);

if (!empty($resultaat)) {
    verstuurMail($resultaat);
    $_SESSION['wachtwoordVergetenStap'] = 1;
    header('location: /profiel/wachtwoordemailverificatie.php');

} else {
    $_SESSION['error'] = "emailOnbekend";
    header('location: /profiel/wachtwoordvergeten.php');
}




