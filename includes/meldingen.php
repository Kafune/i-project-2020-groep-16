<?php
$errormsg = "";
$successmsg = "";

if (isset($_SESSION['error'])) {
    switch ($_SESSION['error']) {
        //email
        case "errorEmailOnbekend":
            $errormsg = "Opgegeven emailadres is niet bekend";
            break;
        case "errorEmailBekend":
            $errormsg = "Deze emailadres is al geregistreerd binnen ons systeem!";
            break;
        //gebruikersnaam
        case "errorGebruikersnaamBekend":
            $errormsg = "Deze gebruikersnaam bestaat al! Kies een nieuwe gebruikersnaam uit.";
            break;
        //verificatiecode niet goed ingevoerd
        case "errorVerificatieOnjuist":
            $errormsg = "Verificatiecode is onjuist!";
            break;
        //oud wachtwoord niet goed ingetypt
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
        case "errorOnjuistLogin":
            $errormsg = "Verkeerde gebruikersnaam en/of wachtwoord ingevoerd!";
            break;
        case "errorVraagOnjuist":
            $errormsg = "Uw geheime vraag is niet juist beantwoord!";
            break;
        case "incorrectWachtwoord":
            $errormsg = "Verkeerd wachtwoord";
            break;
        case "errorQueryMislukt":
            $errormsg = "Gegevens veranderen mislukt. Neem contact op via het contactformulier.";
            break;
        case "errorWachtwoordGeenMatch":
            $errormsg = "Ingevuld wachtwoord komt niet met elkaar overeen!";
            break;
        default:
            $errormsg = "";
    }
}

if (isset($_SESSION['success'])) {
    switch ($_SESSION['success']) {
        case "succesUitloggen":
            $successmsg = "U bent succesvol uitgelogd!";
            break;
        case "succesAccountAanmaken":
            $successmsg = "U heeft succesvol een account aangemaakt!";
            break;
    }
}

// laat de foutmelding zien. geef de CSS class van Bulma aan om de achtergrondkleur te wijzigen
function laatMeldingZien($achtergrondkleur = "has-background-warning") {
    global $errormsg;
    if (isset($_SESSION['error'])) :
        unset($_SESSION['error']);
        ?>
        <div class="errormsg">
            <h1 class="title has-text-centered is-fullwidth <?= $achtergrondkleur ?>"><?= $errormsg ?></h1>
        </div>
    <?php
    endif;
}