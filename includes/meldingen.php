<?php
$message = "";

if (isset($_SESSION['error'])) {
    switch ($_SESSION['error']) {
        //email
        case "errorEmailOnbekend":
            $message = "Opgegeven emailadres is niet bekend";
            break;
        case "errorEmailBekend":
            $message = "Deze emailadres is al geregistreerd binnen ons systeem!";
            break;
        //gebruikersnaam
        case "errorGebruikersnaamBekend":
            $message = "Deze gebruikersnaam bestaat al! Kies een nieuwe gebruikersnaam uit.";
            break;
        //verificatiecode niet goed ingevoerd
        case "errorVerificatieOnjuist":
            $message = "Verificatiecode is onjuist!";
            break;
        //oud wachtwoord niet goed ingetypt
        case "errorWachtwoordOngeldig":
            $message = "Uw huidige wachtwoord is niet correct ingevoerd!";
            break;
        //wachtwoord
        case "errorWachtwoordLengte":
            $message = "Uw nieuwe wachtwoord moet minimaal 7 lang zijn!";
            break;
        case "errorWachtwoordLetters":
            $message = "Uw nieuwe wachtwoord moet minimaal 1 letter bevatten!";
            break;
        case "errorWachtwoordCijfers":
            $message = "Uw nieuwe wachtwoord moet minimaal 1 cijfer bevatten!";
            break;
        case "errorOnjuistLogin":
            $message = "Verkeerde gebruikersnaam en/of wachtwoord ingevoerd!";
            break;
        case "errorVraagOnjuist":
            $message = "Uw geheime vraag is niet juist beantwoord!";
            break;
        case "errorQueryMislukt":
            $message = "Gegevens veranderen mislukt. Neem contact op via het contactformulier.";
            break;
        case "errorWachtwoordGeenMatch":
            $message = "Ingevuld wachtwoord komt niet met elkaar overeen!";
            break;
        case "errorMinderJarig":
            $message = "U moet 18 jaar of ouder zijn om te kunnen registreren!";
            break;
        default:
            $message = "";
    }
}

if (isset($_SESSION['success'])) {
    switch ($_SESSION['success']) {
        case "succesUitloggen":
            $message = "U bent succesvol uitgelogd!";
            break;
        case "succesInloggen":
            $message = "U bent succesvol ingelogd!";
            break;
        case "succesAccountVerwijderd":
            $message = "Uw account is succesvol verwijderd!";
            break;
        case "succesAccountAanmaken":
            $message = "U heeft succesvol een account aangemaakt!";
            break;
        case "succesContactFormVerstuurd":
            $message = "Uw bericht is succesvol verstuurd! U krijgt binnenkort een reactie van ons terug.";
            break;
        case "succesGegevensBewerkt":
            $message = "Uw gegevens zijn succesvol bijgewerkt!";
            break;
        default:
            $message = "";
    }
}


// laat de foutmelding zien. geef de CSS class van Bulma aan om de achtergrondkleur te wijzigen
function laatMeldingZien($achtergrondkleur = "")
{
    global $message;
    $achtergrondkleuren = array("has-background-warning", "has-background-success");

    if (isset($_SESSION['error'])) :
        unset($_SESSION['error']);
        if ($achtergrondkleur == "") {
            $achtergrondkleur = "has-background-warning";
        }
        $achtergrondkleuren[0] = $achtergrondkleur;
        ?>
        <div class="errormsg">
            <h1 class="title has-text-centered is-fullwidth <?= $achtergrondkleuren[0] ?>"><?= $message ?></h1>
        </div>
    <?php
    elseif(isset($_SESSION['success'])) :
        unset($_SESSION['success']);
        if ($achtergrondkleur == "") {
            $achtergrondkleur = "has-background-success";
        }
        $achtergrondkleuren[1] = $achtergrondkleur;
        ?>
        <div class="successmsg">
            <h1 class="title has-text-centered is-fullwidth <?= $achtergrondkleuren[1] ?>"><?= $message ?></h1>
        </div>
    <?php
    endif;
}