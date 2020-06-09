<?php
$message = "";

// kijk of er een error sessie is gezet
if (isset($_SESSION['error'])) {
    // kijk welke error sessie er is gezet. Op basis daarvan wordt er een andere bericht weergegeven door het systeem.
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
        case "errorVerkoperRegistratie":
            $message = "Verificatiecode fout. Probeer het nog een keer.";
            break;
        case "subrubrieken_aanwezig":
            $message = "Verwijder eerst de sub-rubrieken.";
            break;
        case "zelfdeGebruiker":
            $message = "U moet eerst overboden worden voordat u opnieuw kunt bieden.";
            break;
        case "bodTeLaag":
            $message = "Uw bod is lager of gelijk dan het hoogste bod.";
            break;
        case "bodLagerDanStartprijs":
            $message = "Uw bod is lager dan de startprijs.";
            break;
        case "veilingGesloten":
            $message = "U kunt niet meer bieden, de veiling is al gesloten.";
            break;
        case "biedenVerkoper":
            $message = "U kunt niet op uw eigen voorwerpen bieden.";
            break;
        case "errorGeblokkeerd":
            $message = "Gebruiker is geblokkeerd!";
            break;
        case "bestaandeReview":
            $message = "Er bestaat al een review over dit product, probeer een ander product te kiezen. <br> Als dit probleem zich blijft voordoen, neem contact op met de webmaster.";
            break;
        case "errorBodNietIngelogd":
            $message = "U moet ingelogd zijn om een bod te plaatsen!";
            break;
        case "errorLeegZoekOpdracht":
            $message = "U heeft geen zoekopdracht gedaan!";
            break;
	case "errorBijUploaden":
            $message = "Er is een error opgetreden bij het uploaden van uw bestand.";
            break;
        case "verkeerdBestand":
            $message = "Uw foto heeft geen juist formaat, upload in JPG, JPEG of PNG.";
            break;
        case "bestandTeGroot":
            $message = "Uw foto is te groot, probeer een klein bestand te uploaden.";
            break;
        case "errorBijUploaden":
            $message = "Er is een error opgetreden bij het uploaden van uw bestand.";
            break;
        case "verkeerdBestand":
            $message = "Uw foto is geen juist formaat.";
            break;
        case "bestandTeGroot":
            $message = "Uw foto is te groot, probeer een klein bestand te uploaden.";
            break;
        case 'gebruikersnaamTekens':
            $message = "Uw gekozen gebruikersnaam bevat speciale tekens, kies een nieuwe gebruikersnaam.";
            break;
        default:
            $message = "";
    }
}

// Kijk of er een success sessie wordt gezet. Dit proces is hetzelfde als bij de error systeem.
if (isset($_SESSION['success'])) {
    switch ($_SESSION['success']) {
        case "succesUitloggen":
            $message = "U bent succesvol uitgelogd!";
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
        case "succesWachtwoordBijwerken":
            $message = "Uw wachtwoord is succesvol bijgewerkt!";
            break;
        case "succesVerkoperRegistratie":
            $message = "U bent nu als verkoper registreerd!";
            break;
        case "successAdminGebruikerWijzigen":
            $message = "Wijzigen van gebruiker succesvol uitgevoerd.";
            break;
        case "rubriekToevoegen":
            $message = "De rubriek is succesvol toegevoegd";
            break;
        case "rubriekGewijzigd":
            $message = "De rubriek is succesvol gewijzigd";
            break;
        case "rubriekVerwijdert":
            $message = "De rubriek is succesvol verwijdert.";
            break;
        case "successVeilingBlokkeren":
            $message = "Voorwerp is succesvol geblokkeerd!";
            break;
        case "successVeilingDeBlokkeren":
            $message = "Voorwerp is niet meer geblokkeerd!";
            break;
        case "successGebruikerVerwijderen":
            $message = "Gebruiker is succesvol verwijderd!";
            break;
        default:
            $message = "";
    }
}


// laat de foutmelding zien. geef de CSS class van Bulma aan om de achtergrondkleur te wijzigen
function laatMeldingZien($achtergrondkleur = "")
{
    global $message;
    $achtergrondkleuren = array("has-background-black", "has-background-white");

    if (isset($_SESSION['error'])) :
        unset($_SESSION['error']);
        if ($achtergrondkleur == "") {
            $achtergrondkleur = "has-background-black";
        }
        $achtergrondkleuren[0] = $achtergrondkleur;
        ?>
        <div class="errormsg">
            <h1 class="title has-text-centered is-fullwidth has-text-white <?= $achtergrondkleuren[0] ?>"><?= $message ?></h1>
        </div>
    <?php
    elseif (isset($_SESSION['success'])) :
        unset($_SESSION['success']);
        if ($achtergrondkleur == "") {
            $achtergrondkleur = "has-background-white";
        }
        $achtergrondkleuren[1] = $achtergrondkleur;
        ?>
        <div class="successmsg">
            <h1 class="title has-text-centered is-fullwidth has-text-black <?= $achtergrondkleuren[1] ?>"><?= $message ?></h1>
        </div>
    <?php
    endif;
}