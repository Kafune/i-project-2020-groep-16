<?php
include_once ('db.php');

$gebruiker = $_SESSION['gebruiker'];

$sql = "SELECT * FROM Gebruiker WHERE gebruikersnaam = ".$gebruiker."";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

if($result['geblokkeerd'] = 1){
    header('Location: /scripts/logout.php');
}

$sql = "UPDATE Voorwerp
SET veilinggesloten = (case when veilingeinde > CURRENT_TIMESTAMP THEN 0 ELSE 1 END)";

$stmt = $conn->prepare($sql);
$stmt->execute();

$sql = "UPDATE Voorwerp
SET Koper = (SELECT TOP 1 gebruiker FROM Bod WHERE bod.Voorwerp = Voorwerp.voorwerpnummer ORDER BY bodbedrag DESC)
WHERE veilingGesloten = 1";

$stmt = $conn->prepare($sql);
$stmt->execute();