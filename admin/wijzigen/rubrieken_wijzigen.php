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
<div class="column is-9" style="padding-top: 3rem">
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
                        <label for="rubrieknummer">Rubrieknummer</label>
                        <input type="number" name="rubrieknummer" id="rubrieknummer" class="input"
                               value="<?= $resultaat['rubrieknummer'] ?>" required>
                    </div>
                    <div class="field">
                        <input type="hidden" name="rubrieknummeroud" id="rubrieknummeroud" class="input"
                               value="<?= $resultaat['rubrieknummer'] ?>" hidden>
                    </div>
                </div>
                <div class="column is-half has-text-weight-bold">
                    <div class="field">
                        <label for="parent">Parent rubriek</label>
                        <input type="text" name="parent" id="parent" class="input"
                               value="<?= $resultaat['rubriek'] ?>"><br>
                    </div>
                    <div class="field">
                    <button type="submit" name="wijzigen" id="wijzigen" class="button is-primary">Wijzigen</button>
                    </>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
