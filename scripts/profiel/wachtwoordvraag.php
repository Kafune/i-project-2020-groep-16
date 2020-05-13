<?php
session_start();
require_once('../../includes/root.php');
require_once('../../includes/db.php');

$_SESSION['email'] = $_POST['email'];

$resultaat = haalGebruikerInfo($conn, $_SESSION['email']);

if (!empty($resultaat)) {
    genereerVerificatieCode();
    verstuurMail($resultaat);
    $_SESSION['wachtwoordVergetenStap'] = 1;
    header('location: /profiel/wachtwoordemailverificatie.php');

} else {
    $_SESSION['error'] = "emailOnbekend";
    header('location: /profiel/wachtwoordvergeten.php');
}


function haalGebruikerInfo($dbconnectie, $email)
{
    //Check eerst of de e-mail al bestaat in de gebruikersdatabase
    $sql = "SELECT email, gebruikersnaam
            FROM Gebruiker 
            WHERE email = :email";
    $stmt = $dbconnectie->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultaat;
}