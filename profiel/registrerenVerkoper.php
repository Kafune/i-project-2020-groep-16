<?php
include_once("../includes/header.php");

if(empty($_SESSION['gebruiker'])) {
    header("Location: index.php");
}
?>

<div class="columns is-centered">
    <section class="section is-small">
        <div class="container">
            <h1 class="title">Registreren Verkopersaccount</h1>
            <h2 class="subtitle"> Vul hieronder uw gegevens in en begin direct met het verkopen van objecten! </h2>
            <h5 class="has-text-danger subtitle is-6">Als u geen creditcard tot uw beschikking heeft, wordt er per post een brief verstuurd ter controle.</h5>

            <form method="post" action="/scripts/register-verkoper.php">
                <div class="field">
                    <label class="label" for="gebruikersnaam">Gebruikersnaam</label>
                    <div class="control">
                        <input name="gebruikersnaam" id="gebruikersnaam" class="input" type="text" value="<?php echo $_SESSION['gebruiker']?>" disabled required>
                    </div>
                </div>

                <div class="field">
                    <label for="banknaam" class="label">Banknaam</label>
                    <div class="control">
                        <input name="banknaam" id="banknaam" class="input" type="text" required>
                    </div>
                </div>

                <div class="field">
                    <label for="rekeningnummer" class="label">Rekeningnummer (IBAN)</label>
                    <div class="control">
                        <input name="rekeningnummer" id="rekeningnummer" class="input" type="text" required>
                    </div>
                </div>

                <div class="field">
                    <label for="creditcardnummer" class="label">Creditcardnummer</label>
                    <div class="control">
                        <input name="creditcardnummer" id="creditcardnummer" class="input" type="number" placeholder="Dit veld is optioneel.">
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" required>
                            Ik ga akkoord met de verkopersvoorwaarden
                        </label>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-success" type="submit" name="registreerverkoper">Verzenden</button>
                    </div>
                    <div class="control">
                        <button class="button is-danger" type="reset">Annuleren</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?php
include_once("../includes/footer.php");
?>
