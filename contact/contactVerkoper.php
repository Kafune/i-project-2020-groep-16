<?php
session_start();
include_once("../includes/header.php");
require_once('../includes/root.php');
include_once('../includes/db.php');
global $conn;

if (empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}

?>

<div class="columns is-centered">
    <section class="section is-small">
        <div class="container">
            <h1 class="title">Contact opnemen met verkoper</h1>
            <h2 class="subtitle"> Voor als u problemen of vragen heeft over een product </h2>
            <h5 class="has-text-danger subtitle is-6">Zoeken op gebruiker is hoofdlettergevoelig</h5>

            <div class="field">
                <label class="label" for="zoekbalk">Verkoper zoeken</label>
                <div class="control">
                    <script type="text/javascript">
                        function searchUser() {
                            let input = document.getElementById('zoekbalk').value;
                            let output = document.getElementById('gebruikersnaamverkoper').options;
                            for (let i = 0; i < output.length; i++) {
                                if (output[i].value.indexOf(input) === 0) {
                                    output[i].selected = true;
                                }
                                if (document.getElementById('zoekbalk').value === '') {
                                    output[0].selected = true;
                                }
                            }
                        }
                    </script>
                    <input name="zoekbalk" id="zoekbalk" class="input" type="text" onkeyup="searchUser()">
                </div>
            </div>

            <form method="post" action="../scripts/stuurBerichtVerkoper.php" id="contactform">
                <div class="field">
                    <label class="label" for="gebruikersnaamverkoper">Gebruikersnaam Verkoper</label>
                    <div class="select">
                        <select id="gebruikersnaamverkoper" name="gebruikersnaamverkoper">
                            <?php
                            $sql = "SELECT gebruikersnaam FROM Verkoper";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row["gebruikersnaam"] . '">' . $row["gebruikersnaam"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label for="vraagtype" class="label">Vraagtype</label>
                    <div class="select">
                        <select name="vraagtype" id="vraagtype">
                            <option value="" disabled>-- VRAGEN --</option>
                            <option value="vraag over product">Vraag over product</option>
                            <option value="vraag over verzending">Vraag over verzending</option>
                            <option value="bestelling annuleren">Bestelling annuleren</option>
                            <option value="factuur opvragen">Factuur opvragen</option>
                            <option value="overige vraag">Overige vraag</option>
                            <option value="" disabled>-- PROBLEMEN --</option>
                            <option value="item niet ontvangen">Item niet ontvangen</option>
                            <option value="product kapot">Product kapot</option>
                            <option value="incorrecte productgegevens">Incorrecte productgegevens</option>
                            <option value="incorrecte afschrijving">Incorrecte bankafschrijving</option>
                            <option value="overig probleem">Overig probleem</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label for="invoerveld" class="label">Bericht</label>
                    <textarea class="textarea" id="invoerveld" name="invoerveld"></textarea>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-success" type="submit" name="contactverkoper">Verzenden</button>
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
include_once("../includes/footer.html");
?>

