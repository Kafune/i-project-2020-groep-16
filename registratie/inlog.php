<?php
include_once("../includes/header.php");
?>
    <link rel="stylesheet" href="styles/css/mystyles.css">
    <link rel="stylesheet" href="styles/custom_styles.css">

    <title>Registreer</title>

    <div class="has-background-black has-text-white">
        <div class="container">
            <br><br>
            <div class="block">
                <div class="columns">
                    <div class="column is-one-third" style="margin: 1rem">
                        <h1 class="is-size-2 has-text-centered">Registreren</h1>
                        <br>
                        <p>Iedereen die iets wil kopen of verkopen via EenmaalAndermaal,
                            moet zich als gebruiker inschrijven.
                            U zal worden gevraagd om persoonsgegevens in te vullen waarmee een account gemaakt word.
                            <br><br>
                            U kunt nu een gebruikersnaam kiezen.
                            Bij EenmaalAndermaal is de gebruikersnaam de unieke identificator van de gebruiker.
                            Het systeem controleert of de opgegeven gebruikersnaam al bestaat.
                            Zo ja, dan moet u een nieuwe opgeven.
                            De controle herhaalt zich totdat een nog niet bestaande gebruikersnaam gekozen is.
                            Ook moet u een wachtwoord verzinnen (minimaal 7 tekens bestaande uit zowel letters als cijfers,
                            hoofdlettergevoelig).
                            <br><br>
                        </p>
                    </div>
                    <div class="column is-one-third">
                        <form action="../scripts/registreren/inlog_script.php" method="post">
                            <div class="field">
                                <label for="gebruikersnaam" class="label has-text-white">Gebruikersnaam</label>
                                <input type="text" class="input" id="gebruikersnaam" name="gebruikersnaam" required>
                            </div>
                            <div class="field">
                                <label for="wachtwoord" class="label has-text-white">Wachtwoord</label>
                                <input type="password" class="input" id="wachtwoord" name="wachtwoord" required>
                            </div>
                            <button name="accountCheck" class="button is-fullwidth is-primary">Volgende</button>
                        </form>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>
<?php
include_once("includes/footer.php");
?>