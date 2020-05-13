<?php
session_start();
if($_SESSION['wachtwoordVergetenStap'] == 1) {
    if (isset($_POST['wachtwoord-vergeten-codeverificatie'])) {
        if (checkGegevens($_POST['code'], $_SESSION['verificatieCode'])) {
            $_SESSION['wachtwoordVergetenStap'] = 2;
            header('location: /profiel/wachtwoordvraag.php');
        } else {
            $_SESSION['error'] = "verificatieOnjuist";
            header('location: /profiel/wachtwoordemailverificatie.php');
        }
    }
} else {
    header('location: /profiel/wachtwoordvergeten.php');
}

function checkGegevens($clientResultaat, $databaseResultaat)
{
    if ($clientResultaat == $databaseResultaat) {
        return true;
    }
    return false;
}