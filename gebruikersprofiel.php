<?php
include_once("includes/header.php");
?>
<link rel="stylesheet" href="styles/css/mystyles.css">
<link rel="stylesheet" href="styles/custom_styles.css">

<div class="has-background-black has-text-white">
    <div class="container">
        <div class="block">
            <br><br>
            <h1 class="title is-2 has-text-white has-text-centered">Mijn profiel</h1>
            <br>
            <hr>
            <div class="columns">
                <!-- dit moet alleen te zien zijn als de gebruiker ingelogd is -->
                <div class="column">
                    <h2 class="title is-3 has-text-white">Standaard account</h2>
                    <div class="columns">
                        <div class="column has-text-weight-bold">
                            <p>Naam</p>
                            <p>Gebruikersnaam</p>
                            <p>Geboortedatum</p>
                            <br>
                            <p>Adres</p>
                            <p>Postcode</p>
                            <p>Plaats</p>
                            <p>Land</p>
                            <br>
                            <p>Email</p>
                            <p>Telefoon</p>
                            <p>Mobiel</p>
                        </div>
                        <div class="column">
                            <p><?=$voornaam?> <?=$achternaam?></p>
                            <p><?=$gebruikersnaam?></p>
                            <p><?=$GeboorteDag?></p>
                            <br>
                            <p><?=$adresregel1?></p>
                            <p><?=$postcode?></p>
                            <p><?=$plaatsnaam?></p>
                            <p><?=$Land?></p>
                            <br>
                            <p><?=$MailBox?></p>
                            <p>telefoon</p>
                            <p>mobiel</p>
                        </div>
                    </div>
                </div>
                <!-- dit moet alleen te zien zijn als de gebruiker ingelogd is en een verkoopaccount heeft -->
                <div class="column">
                    <h2 class="title is-3 has-text-white">Verkopers account</h2>
                    <div class="columns">
                        <div class="column has-text-weight-bold">
                            <p>Bank</p>
                            <p>Controle via</p>
                            <p>Creditcardnummer</p>
                            <p>Rekeningnummer</p>
                        </div>
                        <div class="column">
                            <p><?=$Bank?></p>
                            <p><?=$Controle-optie?></p>
                            <p><?=$Creditcard?></p>
                            <p><?=$Bankrekening?></p>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <!-- deze knop moet linken naar 'Mijn veilingen-pagina' -->
            <a href="" class="button is-primary">Naar mijn veilingen</a>
            <br><br>
            <!-- dit moet linken naar pagina 'Wijzig accountgegevens'-->
            <a href="">Wijzig accountgegevens</a>
            <br>
            <!-- dit moet linken naar pagina 'AVG-verwijderformulier'-->
            <a href="">Verwijder gebruikersprofiel</a>
            <br><br>
        </div>
    </div>
</div>
<?php
include_once("includes/footer.php");
?>