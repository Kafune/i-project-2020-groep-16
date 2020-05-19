<?php
session_start();
include_once('../../includes/functies.php');

if($_SESSION['wachtwoordVergetenStap'] == 1) {
    if (isset($_POST['wachtwoord-vergeten-codeverificatie'])) {
        if (checkGegevens($_POST['code'], $_SESSION['verificatieCode'])) {
            $_SESSION['wachtwoordVergetenStap'] = 2;
            header('location: /profiel/wachtwoordvraag.php');
        } else {
            $_SESSION['error'] = "errorVerificatieOnjuist";
            header('location: /profiel/wachtwoordemailverificatie.php');
        }
    }
} else {
    header('location: /profiel/wachtwoordvergeten.php');
}