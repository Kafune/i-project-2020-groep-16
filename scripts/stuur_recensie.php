<?php
session_start();
include_once("../includes/db.php");

global $conn;
$verkoper_redirect = $_SESSION['verkoper'];

if (empty($_SESSION['gebruiker'])) {
    header("Location: ../index.php");
}


if (isset($_POST['recenseren'])) {
    $gebruikersnaam = $_SESSION['gebruiker'];
    $waardering = $_POST['waardering'];
    $voorwerp = $_POST['voorwerp'];
    $bericht = $_POST['bericht'];
    $datum = date('Y-m-d');
    $gebruikerssoort = "koper";

    try {
        $sql = "INSERT INTO FEEDBACK (voorwerpnummer, soortgebruiker, gebruikersnaam, feedbacksoort, datum, commentaar)
            VALUES (
                    :voorwerp,
                    :soortgebruiker,
                    :gebruikersnaam,
                    :waardering,
                    :datum,
                    :bericht
            )";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':voorwerp', $voorwerp);
        $stmt->bindParam(':soortgebruiker', $gebruikerssoort);
        $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmt->bindParam(':waardering', $waardering);
        $stmt->bindParam(':datum', $datum);
        $stmt->bindParam(':bericht', $bericht);

        $stmt->execute();
        header("Location: ../verkoper/verkoperpagina.php?verkoper=$verkoper_redirect");
    } catch (PDOException $e) {
        include_once("../includes/header.php");
        echo "
    <script type='text/javascript'>function browserBack() {window.history.back()}</script>
    <article class=\"message is-warning\">
    <div class=\"message-body\">
    Er bestaat al een review over dit product, probeer een ander product te kiezen. Als dit probleem zich blijft voordoen, neem contact op met de webmaster. <a onclick='browserBack()'>Ga terug</a>
    </div>
    </article>
    ";
        include_once("../includes/footer.php");
    }
}