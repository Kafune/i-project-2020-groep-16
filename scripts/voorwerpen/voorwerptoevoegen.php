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
$veilingbegin = date("Y-m-d H:i:s");
$veilingeinde = date("Y-m-d H:i:s", strtotime($veilingbegin . '+' . $looptijd . 'days'));
$rubrieknummer = $_POST['rubrieknummer'];


$sql_insertvoorwerp = "INSERT INTO Voorwerp (titel, beschrijving, startprijs, betalingswijze,
        betalingsinstructie, plaatsnaam, land, looptijd, veilingbegin, verzendkosten,
        verzendinstructies, verkoper, veilingeinde, veilingGesloten)
        VALUES (:titel, :beschrijving, :startprijs, :betalingswijze,
        :betalingsinstructie, :plaatsnaam, :land, :looptijd, :veilingbegin, :verzendkosten,
        :verzendinstructies, :verkoper, :veilingeinde, 0)";


$stmt2 = $conn->prepare($sql_insertvoorwerp);
$stmt2->bindParam(':titel', $titel);
$stmt2->bindParam(':beschrijving', $beschrijving);
$stmt2->bindParam(':startprijs', $startprijs);
$stmt2->bindParam(':betalingswijze', $betalingswijze);
$stmt2->bindParam(':betalingsinstructie', $betalingsinstructie);
$stmt2->bindParam(':plaatsnaam', $plaatsnaam);
$stmt2->bindParam(':land', $land);
$stmt2->bindParam(':looptijd', $looptijd);
$stmt2->bindParam(':veilingbegin', $veilingbegin);
$stmt2->bindParam(':verzendkosten', $verzendkosten);
$stmt2->bindParam(':verzendinstructies', $verzendinstructies);
$stmt2->bindParam(':verkoper', $verkoper);
$stmt2->bindParam(':veilingeinde', $veilingeinde);
$stmt2->execute();

//Toevoegen van afbeeldingen aan de database
$voorwerpnummer = $conn->lastInsertId();

$sql_insertrubriek = "INSERT INTO VoorwerpInRubriek (voorwerpnummer, rubrieknummer) VALUES (".$voorwerpnummer.",".$rubrieknummer.")";
$stmt = $conn->prepare($sql_insertrubriek);
$stmt->execute();

$file = $_FILES['file'];
$fileName = $file['name'];
$fileTmpName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];

$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));


if ($fileError === 0) {
    if ($fileSize < 1000000) {
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = '../../upload/' . $fileNameNew;

        move_uploaded_file($fileTmpName, $fileDestination);

        $sql = "INSERT INTO Bestand (filenaam, voorwerpnummer) VALUES (:fileNameNew, :voorwerpnummer)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fileNameNew', $fileNameNew);
        $stmt->bindParam(':voorwerpnummer', $voorwerpnummer);
        $stmt->execute();

        header("Location:/voorwerpen/voorwerptoevoegenVoltooid.php");

    } else {
        echo 'Bestand te groot!';
    }
} else {
    echo 'Er is iets fout gegaan tijdens het uploaden, probeer het opnieuw!';
}





