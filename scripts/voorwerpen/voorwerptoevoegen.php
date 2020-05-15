<?php
include_once("includes/db.php");

if (!isset($_POST['producttoevoegen'])){
    header("Location: /index.php");
}

$titel = $_POST['titel'];
$beschrijving = $_POST['beschrijving'];
$startprijs = $_POST['startprijs'];
$betalingswijze = $_POST['betalingswijze'];
$betalingsinstructie = $_POST['betalingsinstructie'];
$looptijd = $_POST['looptijd'];
$verzendkosten = $_POST['verzendkosten'];
$verzendinstructies = $_POST['verzendinstructies'];
$verzendinstructies = $_POST['verzendinstructies'];
$verkoper = $_SESSION['gebruiker'];


$sql = "INSERT INTO Voorwerp (titel, beschrijving, startprijs, betalingswijze,
        betalingsinstructie, plaatsnaam, land, looptijd, looptijdbegin, verzendkosten,
        verzendinstructies, verkoper, veilingGesloten, veilingeinde,)";

