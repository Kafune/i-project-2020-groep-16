<?php
$errormsg = "";

if (isset($_SESSION['error'])) {
    switch ($_SESSION['error']) {
        //email
        case "errorEmailOnbekend":
            $errormsg = "Opgegeven email is niet bekend";
            break;
        case "errorVerificatieOnjuist":
            $errormsg = "Verificatiecode is onjuist!";
            break;
        case "errorOudwachtwoordOngeldig":
            $errormsg = "Uw huidige wachtwoord is niet correct ingevoerd!";
            break;
            //wachtwoord
        case "errorWachtwoordLengte":
            $errormsg = "Uw nieuwe wachtwoord moet minimaal 7 lang zijn!";
            break;
        case "errorWachtwoordLetters":
            $errormsg = "Uw nieuwe wachtwoord moet minimaal 1 letter bevatten!";
            break;
        case "errorWachtwoordCijfers":
            $errormsg = "Uw nieuwe wachtwoord moet minimaal 1 cijfer bevatten!";
            break;
        default:
            $errormsg = "";
    }
}
