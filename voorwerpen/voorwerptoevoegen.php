<?php
include_once("../includes/header.php");
include_once("../includes/db.php");

if(empty($_SESSION['verkoper'])) {
    header("Location: /index.php");
}

$sql_rubrieknaam = "SELECT rubrieknaam FROM Rubriek WHERE rubrieknummer = ".$_GET['rubriek']."";
$stmt = $conn->prepare($sql_rubrieknaam);
$stmt->execute();
$resultaat = $stmt->fetch();
$rubrieknaam = $resultaat['rubrieknaam'];
?>

<div class="columns is-centered" style="margin-left: 1rem; margin-right: 1rem">
        <div class="column is-half">
            <br><br>
            <h1 class="title has-text-centered">Voorwerp verkopen</h1>

            <form method="post" action="/scripts/voorwerpen/voorwerptoevoegen.php" enctype="multipart/form-data">

                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label" for="titel">Titel</label>
                            <div class="control">
                                <input name="titel" id="titel" class="input" type="text" maxlength="30" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="beschrijving">Beschrijving</label>
                            <div class="control">
                                <textarea name="beschrijving" id="beschrijving" class="textarea" maxlength="5000" required></textarea>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input name="rubrieknummer" id="rubrieknummer" class="input" type="hidden" value="<?php echo $_GET['rubriek']?>" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="rubrieknaam">Rubrieknaam</label>
                            <div class="control">
                                <input name="rubrieknaam" id="rubrieknaam" class="input" type="text" value="<?php echo $rubrieknaam ?>" disabled required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="afbeelding">Afbeelding</label>
                            <div class="control">
                                <input type="file" id="file" name="file" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label" for="startprijs">Startprijs</label>
                            <div class="control">
                                <input name="startprijs" id="startprijs" class="input" min="0" max="9999999999" type="number" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="betalingswijze">Betalingswijze</label>
                            <div class="control">
                                <select name="betalingswijze" id="betalingswijze" class="select is-fullwidth" required>
                                    <option value="Bankoverschrijving / Giro">Bankoverschrijving / Giro</option>
                                    <option value="Contant">Contant</option>
                                    <option value="iDeal">iDeal</option>
                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="betalingsinstructie">Betalingsintructie</label>
                            <div class="control">
                                <input type="text" name="betalingsinstructie" id="betalingsinstructie" step="0.01" maxlength="50" class="input">
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
                                <input name="verzendkosten" id="verzendkosten" min="0" max="99999999" step="0.01" class="input" type="number">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="verzendinstructies">Verzendinstructies</label>
                            <div class="control">
                                <input type="text" name="verzendinstructies" id="verzendinstructies" maxlength="50" class="input">
                            </div>
                        </div>
                    </div>
                </div>




                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit" name="producttoevoegen">Verzenden</button>
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

