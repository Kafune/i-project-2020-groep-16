<?php
include_once("../includes/header.php");
?>
    <script src="https://api.mqcdn.com/sdk/place-search-js/v1.0.0/place-search.js"></script>
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/place-search-js/v1.0.0/place-search.css"/>

    <script type="text/javascript">
        window.onload = function () {
            placeSearch({
                key: 'IUD1GtpZAWGgjmUGTiLK8J2xUU2IRGRE',
                container: document.querySelector('#search-input'),
                useDeviceLocation: true,
                collection: [
                    'address',
                    'adminArea',
                ],
                templates: {
                    header: function () {
                        return '<span class="mq-header" />'
                    },
                    value: function (result) {
                        return result.name;
                    },
                    empty: function () {
                        return '<div class="mq-result empty-result">Geen steden gevonden</div>'
                    },
                }
            });
        }
    </script>

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
                        </p>
                    </div>
                    <div class="column is-half">
                        <form action="../scripts/registreren/gegevens_script.php" method="post">
                            <div class="field">
                                <label for="voornaam" class="label has-text-white">Voornaam *</label>
                                <input type="text" name="voornaam" id="voornaam" class="input" required>
                            </div>
                            <div class="field">
                                <label for="achternaam" class="label has-text-white">Achternaam *</label>
                                <input type="text" name="achternaam" id="achternaam" class="input" required>
                            </div>
                            <div class="field">
                                <label for="adresregel1" class="label has-text-white">Adresregel 1 *</label>
                                <input type="text" name="adresregel1" id="adresregel1" class="input" required>
                            </div>
                            <div class="field">
                                <label for="adresregel2" class="label has-text-white">Adresregel 2</label>
                                <input type="text" name="adresregel2" id="adresregel2" class="input">
                            </div>
                            <div class="field">
                                <label for="postcode" class="label has-text-white">Postcode *</label>
                                <input type="text" name="postcode" id="postcode" class="input" required>
                            </div>
                            <div class="field">
                                <label for="place-search-input" class="label has-text-white">Plaatsnaam *</label>
                                <input type="search" name="plaatsnaam" id="search-input" class="input" required>
                            </div>
                            <div class="field">
                                <label for="land" class="label has-text-white">Land *</label>
                                <span class="select is-fullwidth">
                                    <select class="select is-fullwidth" name="land" id="land" required>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albanië">Albanië</option>
                                        <option value="Algerije">Algerije</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Antigua-Barbuda">Antigua-Barbuda</option>
                                        <option value="Argentinië">Argentinië</option>
                                        <option value="Armenië">Armenië</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australië">Australië</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrein">Bahrein</option>
                                        <option value="Belize">Belize</option>
                                        <option value="België">België</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnië-Herzegovina">Bosnië-Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazilië">Brazilië</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgarije">Bulgarije</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodja">Cambodja</option>
                                        <option value="Cameroen">Cameroen</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cayman Eilanden">Cayman Eilanden</option>
                                        <option value="Centraal-Afrikaanse Republiek">Centraal-Afrikaanse Republiek</option>
                                        <option value="Chili">Chili</option>
                                        <option value="China">China</option>
                                        <option value="Ciprus">Ciprus</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Cook Eilanden">Cook Eilanden</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Groatië">Groatië</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Denemarken">Denemarken</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominicaanse Republiek">Dominicaanse Republiek</option>
                                        <option value="DR Congo">DR Congo</option>
                                        <option value="Duitsland">Duitsland</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypte">Egypte</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estland">Estland</option>
                                        <option value="Ethiopië">Ethiopië</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Filipijnen">Filipijnen</option>
                                        <option value="Finland">Finland</option>
                                        <option value="Frankrijk">Frankrijk</option>
                                        <option value="Frans Polynesië">Frans Polynesië</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgië">Georgië</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Griekenland">Griekenland</option>
                                        <option value="Groenland">Groenland</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinee-Bissau">Guinee-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haïti">Haïti</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hongarije">Hongarije</option>
                                        <option value="Ierland">Ierland</option>
                                        <option value="IJsland">IJsland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesië">Indonesië</option>
                                        <option value="Irak">Irak</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Israël">Israël</option>
                                        <option value="Italië">Italië</option>
                                        <option value="Ivoorkust">Ivoorkust</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jemen">Jemen</option>
                                        <option value="Joegoslavië">Joegoslavië</option>
                                        <option value="Jordanië">Jordanië</option>
                                        <option value="Kameroen">Kameroen</option>
                                        <option value="Kazachstan">Kazachstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kirgizstan">Kirgizstan</option>
                                        <option value="Koeweit">Koeweit</option>
                                        <option value="Korea">Korea</option>
                                        <option value="Kroatië">Kroatië</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Letland">Letland</option>
                                        <option value="Libanon">Libanon</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libië">Libië</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Litouwen">Litouwen</option>
                                        <option value="Luxemburg">Luxemburg</option>
                                        <option value="Macedonië">Macedonië</option>
                                        <option value="Maleisië">Maleisië</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marokko">Marokko</option>
                                        <option value="Mauritanië">Mauritanië</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Namibië">Namibië</option>
                                        <option value="Nederland" SELECTED>Nederland</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Nieuw Zeeland">Nieuw Zeeland</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Noorwegen">Noorwegen</option>
                                        <option value="Oezbekistan">Oezbekistan</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Oostenrijk">Oostenrijk</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Papoea-Nieuw-Guinea">Papoea-Nieuw-Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Polen">Polen</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Quatar">Quatar</option>
                                        <option value="Roemenië">Roemenië</option>
                                        <option value="Rusland">Rusland</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Salomonseilanden">Salomonseilanden</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Saudi-Arabië">Saudi-Arabië</option>
                                        <option value="Schotland">Schotland</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovenië">Slovenië</option>
                                        <option value="Slowakije">Slowakije</option>
                                        <option value="Somalië">Somalië</option>
                                        <option value="Spanje">Spanje</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Syrie">Syrie</option>
                                        <option value="Tadzjikistan">Tadzjikistan</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Tobago">Tobago</option>
                                        <option value="Tsjechië">Tsjechië</option>
                                        <option value="Tsjaad">Tsjaad</option>
                                        <option value="Tunesië">Tunesië</option>
                                        <option value="Turkije">Turkije</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Trinidad">Trinidad</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Verenigd Koninkrijk">Verenigd Koninkrijk</option>
                                        <option value="Verenigde Staten">Verenigde Staten</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Zaïre">Zaïre</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                        <option value="Zuid-Afrika">Zuid-Afrika</option>
                                        <option value="Zweden">Zweden</option>
                                        <option value="Zwitserland">Zwitserland</option>
                                    </select>
                                </span>
                                </label>
                            </div>
                            <div class="field">
                                <label for="telefoonnummer">Telefoonnummer *</label>
                                <input type="tel" name="telefoonnummer" id="telefoonnummer" class="input" required>
                            </div>
                            <div class="field">
                                <label for="geboortedag" class="label has-text-white">Geboortedag *</label>
                                <input type="date" name="geboortedag" id="geboortedag" class="input" required>
                            </div>
                            <div class="field">
                                <label for="vraag" class="label has-text-white">Geheime vraag *</label>
                                <span class="select is-fullwidth">
                                <label>
                                    <select name="vraag">
                                        <option value="1">In welke straat ben je geboren?</option>
                                        <option value="2">Wat is de meisjesnaam je moeder?</option>
                                        <option value="3">Wat is je lievelingsgerecht?</option>
                                        <option value="4">Hoe heet je oudste zusje?</option>
                                        <option value="5">Hoe heet je huisdier?</option>
                                    </select>
                                </label>
                            </span>
                            </div>
                            <div class="field">
                                <label for="antwoord" class="label has-text-white">Antwoord geheime vraag *</label>
                                <input type="text" name="antwoord" id="antwoord" class="input" required>
                            </div>
                            <input type="submit" name="registreren" class="button is-fullwidth is-primary">
                        </form>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>
<?php
include_once("../includes/footer.php");
?>