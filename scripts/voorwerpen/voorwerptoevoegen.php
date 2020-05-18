<?php
include_once("../../includes/db.php");
session_start();

//if (!isset($_POST['producttoevoegen'])){
//    header("Location: /index.php");
//}

$verkoper = $_SESSION['gebruiker'];

$sql_verkopergegevens = "SELECT plaatsnaam, land FROM Gebruiker WHERE gebruikersnaam = :gebruikersnaam";

$stmt = $conn->prepare($sql_verkopergegevens);
$stmt->bindParam(':gebruikersnaam', $verkoper);
$stmt->execute();

$resultaat = $stmt->fetch(PDO::FETCH_ASSOC);

$plaatsnaam = $resultaat['plaatsnaam'];
$land = $resultaat['land'];

$titel = $_POST['titel'];
$beschrijving = $_POST['beschrijving'];
$startprijs = $_POST['startprijs'];
$betalingswijze = $_POST['betalingswijze'];
$betalingsinstructie = $_POST['betalingsinstructie'];
$looptijd = $_POST['looptijd'];
$verzendkosten = $_POST['verzendkosten'];
$verzendinstructies = $_POST['verzendinstructies'];
$verzendinstructies = $_POST['verzendinstructies'];
$looptijdbegin = date("Y-m-d H:i:s");
$veilingeinde = date("Y-m-d H:i:s", strtotime($looptijdbegin .'+'. $looptijd . 'days'));


$sql_insertvoorwerp = "INSERT INTO Voorwerp (titel, beschrijving, startprijs, betalingswijze,
        betalingsinstructie, plaatsnaam, land, looptijd, looptijdbegin, verzendkosten,
        verzendinstructies, verkoper, veilingeinde)
        VALUES (:titel, :beschrijving, :startprijs, :betalingswijze,
        :betalingsinstructie, :plaatsnaam, :land, :looptijd, :looptijdbegin, :verzendkosten,
        :verzendinstructies, :verkoper, :veilingeinde)";


$stmt2 = $conn->prepare($sql_insertvoorwerp);
$stmt2->bindParam(':titel', $titel);
$stmt2->bindParam(':beschrijving', $beschrijving);
$stmt2->bindParam(':startprijs', $startprijs);
$stmt2->bindParam(':betalingswijze', $betalingswijze);
$stmt2->bindParam(':betalingsinstructie', $betalingsinstructie);
$stmt2->bindParam(':plaatsnaam', $plaatsnaam);
$stmt2->bindParam(':land', $land);
$stmt2->bindParam(':looptijd', $looptijd);
$stmt2->bindParam(':looptijdbegin', $looptijdbegin);
$stmt2->bindParam(':verzendkosten', $verzendkosten);
$stmt2->bindParam(':verzendinstructies', $verzendinstructies);
$stmt2->bindParam(':verkoper', $verkoper);
$stmt2->bindParam(':veilingeinde', $veilingeinde);
$stmt2 -> execute();

header("Location:/voorwerpen/voorwerptoevoegenVoltooid.php");
