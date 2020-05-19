<?php
session_start();

$errormsg = "";

switch($_SESSION['error']) {
    case "emailOnbekend":
        $errormsg = "Opgegeven email is niet bekend";
        break;
    case "verificatieOnjuist":
        $errormsg = "Verificatiecode is onjuist!";
        break;
    default:
        $errormsg = "";
}