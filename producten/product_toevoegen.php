<?php
include_once("../includes/header.php");

//if(empty($_SESSION['gebruiker'])) {
//    header("Location: index.php");
//}
//?>

<div class="columns is-centered">
        <div class="column is-4">
            <h1 class="title">Voorwerp verkopen</h1>

            <form method="post" action="scripts/voorwerp_toevoegen.php">

                <div class="field">
                    <label class="label" for="titel">Titel</label>
                    <div class="control">
                        <input name="titel" id="titel" class="input" type="text" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="beschrijving">Beschrijving</label>
                    <div class="control">
                        <textarea name="beschrijving" id="beschrijving" class="textarea" required></textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="startprijs">Startprijs</label>
                    <div class="control">
                        <input name="startprijs" id="startprijs" class="input" min="0" type="number" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="betalingswijze">Betalingswijze</label>
                    <div class="control">
                        <select name="betalingswijze" id="betalingswijze" class="select is-fullwidth" required>
                            <option value="Contant">Contant</option>
                            <option value="Contant">Bank / Giro</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="betalingsinstructie">Betalingsintructie</label>
                    <div class="control">
                        <textarea name="betalingsinstructie" id="betalingsinstructie" class="textarea"></textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="looptijd">Looptijd</label>
                    <div class="control">
                        <select name="looptijd" id="looptijd" class="select is-fullwidth" required>
                            <option value="1">1 Dag</option>
                            <option value="3">3 Dagen</option>
                            <option value="5">5 Dagen</option>
                            <option value="7">7 Dagen</option>
                            <option value="10">10 Dagen</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="verzendkosten">Verzendkosten</label>
                    <div class="control">
                        <input name="verzendkosten" id="verzendkosten" min="0" class="input" type="number">
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="verzendinstructies">Verzendinstructies</label>
                    <div class="control">
                        <textarea name="verzendinstructies" id="verzendinstructies" class="textarea"></textarea>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit" name="registreerverkoper">Verzenden</button>
                    </div>
                    <div class="control">
                        <button class="button is-primary" type="reset">Annuleren</button>
                    </div>
                </div>
            </form>
        </div>
</div>

<?php
include_once("../includes/footer.php");
?>

