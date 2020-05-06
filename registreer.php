<?php
include_once("includes/header.php");
?>
    <link rel="stylesheet" href="styles/css/mystyles.css">
    <link rel="stylesheet" href="styles/custom_styles.css">

<title>Registreer</title>

<div class="has-background-black has-text-white">
    <div class="container">
        <br><br>
        <div class="block">
            <div class="columns">
                <div class="column is-one-third">
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
                    <form>
                        <label class="label has-text-white">E-mail</label>
                        <div class="field has-addons">
                            <p class="control">
                                <input type="email" class="input" placeholder="Geldig emailadres">
                            </p>
                            <p class="control">
                                <a href="" class="button is-primary">Check email</a>
                            </p>
                        </div>
                        <div class="field">
                            <label class="label has-text-white">Verificatiecode</label>
                            <input type="text" class="input" placeholder="Code">
                        </div>
                        <button class="button is-fullwidth is-success">Verificatiecode verzenden</button>
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