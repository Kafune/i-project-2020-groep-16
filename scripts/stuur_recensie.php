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
}