<?php
include_once('../../../includes/db.php');
session_start();

$rubrieknummer = $_GET['rubrieknummer'];
/*Check of de rubriek geen sub-rubrieken heeft waardoor deze niet bereikbaar zijn*/
$sql_checkforchilds = "SELECT * FROM Rubriek WHERE rubriek = :rubrieknummer";
$stmt = $conn->prepare($sql_checkforchilds);
$stmt->bindParam(':rubrieknummer', $rubrieknummer);
$stmt->execute();

/*Als de rubriek geen sub-rubrieken heeft kan deze verwijdert worden*/
if (empty($stmt->fetch())) {
    $rubrieknummer = $_GET['rubrieknummer'];
    /*Rubriek nummer wordt opgevraagd van de rubriek hoger*/
    $sql_rubriek = "SELECT rubriek FROM Rubriek WHERE rubrieknummer = :rubrieknummer";
    $stmt = $conn->prepare($sql_rubriek);
    $stmt->bindParam(':rubrieknummer', $rubrieknummer);
    $stmt->execute();
    $result = $stmt->fetch();
    $rubriek = $result['rubriek'];


//    /*Alle voorwerpen in de rubriek die verwijdert wordt, worden naar een rubriek hoger verplaatst*/
    $sql_updatevoorwerpen = "UPDATE VoorwerpInRubriek SET rubrieknummer = :rubriek WHERE rubrieknummer = :rubrieknummer";
    $stmt = $conn->prepare($sql_updatevoorwerpen);
    $stmt->bindParam(':rubrieknummer', $rubrieknummer);
    $stmt->bindParam(':rubriek', $rubriek);
    $stmt->execute();

//    /*Rubriek verwijderen uit de rubriek tabel*/
    $sql_verwijder = "DELETE FROM Rubriek WHERE rubrieknummer =:rubrieknummer";
    $stmt = $conn->prepare($sql_verwijder);
    $stmt->bindParam(':rubrieknummer', $rubrieknummer);
    $stmt->execute();

    $_SESSION['success'] = 'rubriekVerwijdert';
    header('Location: ../rubriek_verwijderen.php');
} else {
    $_SESSION['error'] = 'subrubrieken_aanwezig';
    header('Location: ../rubriek_verwijderen.php');
}

