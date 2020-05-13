<?php
include_once("includes/header.php");
?>
<div>
    <div class="tile is-ancestor">
        <div class="tile is-4 is-vertical is-parent">
            <div class="tile is-child box">
                <p class="title">Adresgegevens</p>
                <p class="is-size-5">Straat</p>
                <p>Ruitenberglaan 26</p>
                <br>
                <p class="is-size-5">Postcode</p>
                <p>6826CC</p>
                <br>
                <p class="is-size-5">Plaats</p>
                <p>Arnhem</p>
            </div>
            <div class="tile is-child box">
                <p class="title">Contactgegevens</p>
                <p class="is-size-5">E-mail</p>
                <a href="mailto:iproject16@icasites.nl">iproject16@icasites.nl</a>
                <br><br>
                <p class="is-size-5">Telefoonnummer</p>
                <p>06-00000000</p>
            </div>
        </div>
        <div class="tile is-parent">
            <div class="tile is-child box">
                <p class="title">Contactformulier</p>
                <form method="post" action="scripts/stuurBerichtContact.php">
                    <div class="field">
                        <label class="label" for="naam">Naam</label>
                        <div class="control">
                            <input name="naam" id="naam" class="input" type="text" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="email">E-mail</label>
                        <div class="control">
                            <input name="email" id="email" class="input" type="email" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="onderwerp">Onderwerp</label>
                        <div class="select">
                            <select name="onderwerp" id="onderwerp">
                                <option value="Klacht">Klacht</option>
                                <option value="Fout">Fout</option>
                                <option value="Vacature">Vacature</option>
                                <option value="Overig">Overig</option>
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="bericht">Bericht</label>
                        <div class="control">
                            <textarea class="textarea" id="bericht" name="bericht"></textarea>
                        </div>
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-success" type="submit" name="contactsubmit">Verzenden</button>
                        </div>
                        <div class="control">
                            <button class="button is-danger" type="reset">Annuleren</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <?php
    include_once("includes/footer.php");
    ?>
