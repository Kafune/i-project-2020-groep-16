<?php
include_once("includes/header.php");
include_once("includes/db.php");

if (isset($_SESSION['gebruiker'])) {
    $gebruikersnaam = $_SESSION['gebruiker'];

    $sql = "SELECT * FROM Gebruiker where gebruikersnaam = :gebruikersnaam";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
    $stmt->execute();

    $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);

} else {
    header("Location: /index.php");
}
?>

<div class="has-background-black has-text-white">
    <div class="container">
        <?php
        if(isset($_SESSION['wachtwoordinvoer'])) :
            unset($_SESSION['wachtwoordinvoer']);
        ?>
        <div class="errormsg">
            <h1 class="title has-text-centered is-fullwidth has-background-warning">Wachtwoord verkeerd ingevoerd!</h1>
        </div>
            <?php
        endif;
            ?>
        <div class="block">
            <br><br>
            <h1 class="title is-2 has-text-white has-text-centered">Profiel bewerken</h1>
            <br>
            <hr>
            <div class="columns">
                <!-- dit moet alleen te zien zijn als de gebruiker ingelogd is -->
                    <div class="column">
                        <form action="scripts/profiel/bewerk.php" method="post">

                        <h2 class="title is-3 has-text-white">Accountgegevens</h2>
                        <div class="columns">
                            <div class="column has-text-weight-bold">
                                <p>Voornaam</p>
                                <p>Achternaam</p>
                                <p>Gebruikersnaam</p>
                                <p>Geboortedatum</p>
                                <br>
                                <p>Adresregel1</p>
                                <p>Adresregel2</p>
                                <p>Postcode</p>
                                <p>Plaats</p>
                                <p>Land</p>
                                <br>
                                <p>Email</p>
                            </div>
                            <div class="column persoonlijke-data">
                                <input type="text" name="voornaam" id="voornaam" value="<?= $resultaat['voornaam'] ?>" required><br>
                                <input type="text" name="achternaam" id="achternaam" value="<?= $resultaat['achternaam'] ?>">
                                <p><?= $resultaat['gebruikersnaam'] ?></p>
                                <p><?= $resultaat['geboortedag'] ?></p>
                                <br>
                                <input type="text" name="adresregel1" id="adresregel1" value="<?= $resultaat['adresregel1'] ?>" required><br>
                                <input type="text" name="adresregel2" id="adresregel2" value="<?= $resultaat['adresregel2'] ?>"><br>
                                <input type="text" name="postcode" id="postcode" value="<?= $resultaat['postcode'] ?>"><br>
                                <input type="text" name="plaatsnaam" id="plaatsnaam" value="<?= $resultaat['plaatsnaam']?>"><br>
                                <p><?= $resultaat['land'] ?></p>
                                <br>
                                <p><?= $resultaat['email'] ?></p>

                            </div>

                        </div>
                            <p>Voer uw wachtwoord in om uw aanpassingen te voltooien
                            <input type="password" name="wachtwoord" required></p><br>

                            <input type="submit" name="bewerken" value="Bewerk profiel" class="button is-primary">
                            <a href="/gebruikersprofiel.php" class="button is-primary">Annuleer wijzigingen</a>
                        </form>

            </div>
                <!-- dit moet alleen te zien zijn als de gebruiker ingelogd is en een verkoopaccount heeft -->
                <div class="column">
                    <h2 class="title is-3 has-text-white">Verkopers account</h2>
                    <div class="columns">
                        <div class="column has-text-weight-bold">
                            <p>Bank</p>
                            <p>Controle via</p>
                            <p>Creditcardnummer</p>
                            <p>Rekeningnummer</p>
                        </div>
                        <div class="column">
                            <!--                            <p>--><? //= $bank ?><!--</p>-->
                            <!--                            <p>--><? //= $controle ?><!--</p>-->
                            <!--                            <p>--><? //= $creditcardnummer ?><!--</p>-->
                            <!--                            <p>--><? //= $rekeningnummer ?><!--</p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<?php
include_once("includes/footer.php");
?>