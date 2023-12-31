<?php
include_once("../includes/header.php");
?>
    <link rel="stylesheet" href="/styles/css/mystyles.css">
    <link rel="stylesheet" href="/styles/custom_styles.css">

    <title>Registreer</title>

    <div class="has-background-black has-text-white">
        <div class="container">
            <br><br>
            <div class="block">
                <div class="columns">
                    <div class="column is-half" style="margin: 1rem">
                        <h1 class="is-size-2 has-text-centered">Registreren</h1>
                        <br>
                        <p>Iedereen die iets wil kopen of verkopen via EenmaalAndermaal,
                            moet zich als gebruiker inschrijven.
                            U zal worden gevraagd om persoonsgegevens in te vullen waarmee een account gemaakt word.
                            <br><br>
                            Bij inschrijving moet u eerst een geldig e-mailadres opgeven.
                            Om te controleren of het e-mailadres geldig is,
                            stuurt het systeem een mailtje naar dat adres, met daarin een verificatiecode.
                            Voordat u verder kan met de inschrijving,
                            moet u die code overnemen in het veld "Verificatiecode" en klik op de knop "code verzenden".
                            Het systeem controleert of de ingetypte code dezelfde is als de verstuurde code,
                            en pas als de code klopt kan de u verder met de inschrijving.
                            <br><br>
                        </p>
                    </div>
                    <div class="column is-one-third">
                        <form action="../scripts/registreren/verificatie_code_script.php" method="post">
                            <label class="label has-text-white">Verificatie code</label>
                            <div class="field has-addons">
                                <p class="control">
                                    <input type="text" name="code" class="input" placeholder="1234567">
                                </p>
                                <p class="control">
                                    <input type="submit" name="codeCheck" class="button is-primary">
                                </p>
                            </div>
                        </form>
                        <?=$_SESSION['verificatieCode']?>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>
<?php
include_once("../includes/footer.php");
?>