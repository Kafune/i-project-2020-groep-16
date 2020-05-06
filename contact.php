<?php
include_once("includes/header.php");
?>

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
                <form method="POST">
                    <div class="field">
                        <label class="naam is-size-5">Naam</label>
                        <input type="text" placeholder="Jouw naam" class="input">
                    </div>
                    <div class="field">
                        <label class="email is-size-5">Email</label>
                        <input type="email" placeholder="Jouw e-mailadres" class="input">
                    </div>
                    <div class="field">
                        <label class="onderwerp is-size-5">Onderwerp</label>
                        <div class="control">
                            <div class="select">
                                <select>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="bericht is-size-5">Bericht</label>
                        <textarea class="textarea" placeholder="Jouw bericht"></textarea>
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-link" type="submit">Verzenden</button>
                        </div>
                        <div class="control">
                            <button class="button is-link" type="reset">Annuleren</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php
include_once("includes/footer.html");
?>