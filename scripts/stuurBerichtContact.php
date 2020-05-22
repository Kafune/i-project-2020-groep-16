<?php
session_start();
require_once('../includes/root.php');
include_once('../includes/db.php');

global $conn;

if(isset($_POST['contactsubmit'])) {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $onderwerp = $_POST['onderwerp'];
    $bericht = $_POST['bericht'];

    $berichtFormatted = "
    Een gast of gebruiker heeft het volgende geschreven op ons contactformulier:
    
    $bericht
    
    Een reactie terugsturen kan met het volgende e-mailadres: $email";

    $onderwerp = "eenmaalandermaal - contactformulier - onderwerp: $onderwerp";

    mail("r.florissen@student.han.nl" , "$onderwerp", "$berichtFormatted");

    $_SESSION['success'] = "succesContactFormVerstuurd";
    header("location: ../contact.php");
}