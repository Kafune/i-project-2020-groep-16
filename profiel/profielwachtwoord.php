<?php
include_once("../includes/header.php");
include_once("../includes/db.php");

if (isset($_SESSION['gebruiker'])) {
    $gebruikersnaam = $_SESSION['gebruiker'];

    $sqlKoper = "SELECT gebruikersnaam, wachtwoord FROM Gebruiker where gebruikersnaam = :gebruikersnaam";

    $stmt1 = $conn->prepare($sqlKoper);
    $stmt1->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt1->execute();

    $row = $stmt1->fetch(PDO::FETCH_ASSOC);


} else {
    header("Location: /index.php");
}

$errormsg = "";
if(isset( $_SESSION['wachtwoordCheck'])) {
    if($_SESSION['wachtwoordCheck'] == "oudwachtwoordOngeldig") {
        $errormsg = "Uw huidige wachtwoord is niet correct ingevoerd!";
    } if($_SESSION['wachtwoordCheck'] == "lengte") {
        $errormsg = "Uw nieuwe wachtwoord moet minimaal 7 lang zijn!";
    } if($_SESSION['wachtwoordCheck'] == "letters") {
        $errormsg = "Uw nieuwe wachtwoord moet minimaal 1 letter bevatten!";
    } if($_SESSION['wachtwoordCheck'] == "cijfers") {
        $errormsg = "Uw nieuwe wachtwoord moet minimaal 1 cijfer bevatten!";
    }
}



?>
    <div class="has-background-black has-text-white">
        <div class="container">
            <?php
            if(isset($_SESSION['wachtwoordCheck'])) :
                unset($_SESSION['wachtwoordCheck']);
                ?>
                <div class="errormsg">
                    <h1 class="title has-text-centered is-fullwidth has-background-warning"><?=$errormsg?></h1>
                </div>
            <?php
            endif;
            ?>
            <div class="block">
                <br><br>
                <h1 class="title is-2 has-text-white has-text-centered">Wachtwoord bewerken</h1>
                <br>
                <hr>
                <div class="columns is-centered">
                    <!-- dit moet alleen te zien zijn als de gebruiker ingelogd is -->
                    <div class="column">
                        <p>Om uw nieuwe wachtwoord te veranderen, voert u eerst uw oude wachtwoord in. Vervolgens voert u een nieuw wachtwoord in dat uit minimaal 7 tekens bestaat,
                            <br>en minimaal 1 letter en 1 cijfer bevat.</p><br>

                        <div class="columns">
                            <section class="column is-three-quarters">
                                <form action="scripts/profiel/bewerkwachtwoord.php" method="post">
                                    <div class="field">
                                        <label for="oudwachtwoord">Oud wachtwoord</label>
                                        <input type="password" name="oudwachtwoord" id="oudwachtwoord" class="input" required>
                                    </div>
                                    <div class="field">
                                        <label for="nieuwwachtwoord">Nieuw wachtwoord</label>
                                        <input type="password" name="nieuwwachtwoord" id="nieuwwachtwoord" class="input" required>
                                    </div>
                                    <input type="submit" name="bewerkwachtwoord" value="Bewerk profiel" class="button is-primary">
                                    <a href="/gebruikersprofiel.php" class="button is-primary">Annuleer wijzigingen</a>
                                </form>
                            </section>
                        </div>
                    </div>

                </div>
                <br><br>
            </div>
        </div>
    </div>
<?php
include_once("../includes/footer.php");
?>