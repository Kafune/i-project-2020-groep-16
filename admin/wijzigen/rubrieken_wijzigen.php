<?php
include_once('../../includes/header.php');
include_once('../../includes/db.php');
include_once('../../includes/meldingen.php');
include_once('../menu.php');

$rubrieknummer = $_GET['rubrieknummer'];

$sql = "SELECT * FROM Rubriek where rubrieknummer = :rubrieknummer";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':rubrieknummer', $rubrieknummer);
$stmt->execute();
$resultaat = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="column is-10" style="padding-top: 3rem">
    <section class="hero is-primary welcome is-small">
        <div class="hero-body">
            <div class="container">
                <?php echo '<h1 class="title">Rubriek wijzigen</h1>' ?>
            </div>
        </div>
    </section>
    <div class="column">
        <form action="scripts/rubrieken_wijzigen_script.php" method="post">
            <div class="columns">
                <div class="column is-half has-text-weight-bold">
                    <div class="field">
                        <label for="rubrieknaam">Rubrieknaam</label>
                        <input type="text" name="rubrieknaam" id="rubrieknaam" class="input"
                               value="<?= $resultaat['rubrieknaam'] ?>" required><br>
                    </div>
                    <div class="field">
                        <input type="hidden" name="rubrieknummer" id="rubrieknummer" class="input"
                               value="<?= $resultaat['rubrieknummer'] ?>" hidden>
                    </div>
                    <div class="field">
                        <button type="submit" name="wijzigen" id="wijzigen" class="button is-primary">Wijzingen
                            toepassen
                        </button>
                    </div>
                </div>
                <div class="column is-half has-text-weight-bold">
                    <br><p class="button is-primary"><a
                                href="parent_rubriek_wijzigen.php?rubrieknummer=<?php echo $resultaat['rubrieknummer'] ?>"
                                class="has-text-white has-text-weight-normal">Parent wijzigen</a>
                    </p>
                </div>
        </form>
    </div>
</div>
</div>
