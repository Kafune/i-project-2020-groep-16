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
                        </p>
                    </div>
                    <div class="column is-one-third">
                        <form>
                            <div class="field">
                                <label class="label has-text-white">Voornaam</label>
                                <input type="text" class="input" placeholder="">
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Tussenvoegsel</label>
                                <input type="text" class="input" placeholder="">
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Achternaam</label>
                                <input type="text" class="input" placeholder="">
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Adresregel 1</label>
                                <input type="text" class="input" placeholder="">
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Adresregel 2</label>
                                <input type="text" class="input" placeholder="">
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Huisnummer</label>
                                <input type="text" class="input" placeholder="">
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Postcode</label>
                                <input type="text" class="input" placeholder="">
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Plaatsnaam</label>
                                <input type="text" class="input" placeholder="">
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Land</label>
                                <input type="text" class="input" placeholder="">
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Geboortedag</label>
                                <input type="date" class="input" placeholder="">
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Geheime vraag</label>
                                <p class="control">
                                    <span class="select is-fullwidth">
                                        <select>
                                            <option>In welke straat ben je geboren?</option>
                                            <option>Wat is de meisjesnaam je moeder?</option>
                                            <option>Wat is je lievelingsgerecht?</option>
                                            <option>Hoe heet je oudste zusje?</option>
                                            <option>Hoe heet je huisdier?</option>
                                        </select>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <label class="label has-text-white">Antwoord geheime vraag</label>
                                <input type="text" class="input" placeholder="">
                            </div>
                            <button class="button is-fullwidth is-success">Registreren</button>
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