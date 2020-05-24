<?php
include_once("../includes/header.php");
include_once("../includes/db.php");

global $conn;

if (empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}

$verkoper_GET = $_GET['verkoper'];
$_SESSION['verkoper'] = $verkoper_GET;
$verkoperdetails= $conn->prepare("SELECT plaatsnaam, land, isVerkoper FROM Gebruiker WHERE gebruikersnaam ='".$verkoper_GET."'");
$verkoperdetails->execute();
$row_verkoper = $verkoperdetails->fetch(PDO::FETCH_ASSOC);

$reviewdetails= $conn->prepare("SELECT TOP 7 Feedback.voorwerpnummer, gebruikersnaam, feedbacksoort, datum, commentaar FROM Feedback
LEFT JOIN Voorwerp ON Feedback.voorwerpnummer = Voorwerp.voorwerpnummer
WHERE Voorwerp.verkoper = '".$verkoper_GET."'
ORDER BY datum desc");
$reviewdetails->execute();

$voorwerpdetails = $conn->prepare("SELECT voorwerpnummer, titel FROM Voorwerp WHERE verkoper = '".$verkoper_GET."'");
$voorwerpdetails->execute();

if(!empty($row_verkoper['plaatsnaam']) && $row_verkoper['isVerkoper'] == 1) {
?>

<script src="https://kit.fontawesome.com/5777d3afe9.js" crossorigin="anonymous"></script>

<div class="tile is-ancestor">
    <div class="tile is-4 is-vertical is-parent">
        <div class="tile is-child box">
            <p class="title">Verkoperinfo</p>
            <p class="is-size-5">Gebruikersnaam</p>
            <p><?php echo $verkoper_GET ?></p>
            <p class="is-size-5">Woonplaats</p>
            <p><?php echo $row_verkoper['plaatsnaam'] ?></p>
            <p class="is-size-5">Land</p>
            <p><?php echo $row_verkoper['land'] ?></p>
            <br>
            <a class="button is-info" href="../contact/contactVerkoper.php?verkoper=<?=$verkoper_GET?>">Bericht Sturen</a>

        </div>
        <div class="tile is-child box">
            <p class="title">Review Schrijven</p>
            <form method="post" action="../scripts/stuur_recensie.php">
                <div class="field">
                    <label for="gebruikersnaam" class="label">Gebruikersnaam</label>
                    <div class="control">
                        <input class="input" type="text" name="gebruikersnaam" id="gebruikersnaam" value="<?php echo $_SESSION['gebruiker']?>" disabled>
                    </div>
                </div>
                <div class="field">
                    <label for="waardering" class="label">Waardering</label>
                    <div class="select">
                        <select id="waardering" name="waardering">
                            <option value="positief">Positief</option>
                            <option value="neutraal" selected>Neutraal</option>
                            <option value="negatief">Negatief</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label for="voorwerp" class="label">Voorwerp</label>
                    <div class="select">
                        <select id="voorwerp" name="voorwerp">
                            <?php
                            while($row_voorwerp = $voorwerpdetails->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row_voorwerp["voorwerpnummer"] . '" >' . $row_voorwerp["titel"] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label for="bericht" class="label">Bericht (max. 100 tekens)</label>
                    <div class="control">
                        <textarea class="textarea is-small" id="bericht" name="bericht" maxlength="100" required></textarea>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-success" type="submit" name="recenseren">Verzenden</button>
                    </div>
                    <div class="control">
                        <button class="button is-danger" type="reset">Annuleren</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="tile is-parent">
        <div class="tile is-child box">
            <p class="title">Nieuwste Reviews</p>
            <?php while($row_review = $reviewdetails->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="box">
                <article class="media">
                    <div class="media-left">
                        <span class="icon">
                            <?php if($row_review['feedbacksoort'] === 'Positief' || $row_review['feedbacksoort'] === 'positief') {
                                echo"<i class='far fa-smile'></i>";
                            } else if($row_review['feedbacksoort'] === 'Neutraal' || $row_review['feedbacksoort'] === 'neutraal') {
                                echo"<i class='far fa-meh'></i>";
                            } else {
                                echo"<i class='far fa-angry'></i>";
                            }
                            ?>
                        </span>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong><?php echo $row_review['gebruikersnaam'] ?></strong> <small><?php echo $row_review['datum'] ?></small>
                                <br>
                                <?php echo $row_review['commentaar'] ?>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
} else {
    echo "
    <article class=\"message is-warning\">
    <div class=\"message-body\">
    Gebruiker is geen verkoper of bestaat niet, neem contact op met de webmaster als dit probleem zich blijft voordoen. <a href='../index.php'>Ga terug</a>
    </div>
    </article>
    ";
}
include_once("../includes/footer.php");

?>

